<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function basket()
    {
        $user = session('id');
        $products = DB::select('SELECT `baskets`.*, products.name, products.price, products.description, products.photo FROM baskets INNER JOIN products WHERE `products_id`=products.id AND users_id = ?', [$user]);
        $sum = DB::select('select SUM(count*price) AS sum from `baskets` where `users_id` = ?', [$user]);
        if($products != []) {
            $ingr = [];

            foreach ($products as $item){
                $one = DB::select('SELECT `ing_in_bask`.*, ingridients.name as ingr, baskets.id as bask FROM `ing_in_bask` INNER JOIN baskets INNER JOIN ingridients WHERE `ing_id` = ingridients.id AND `basket_id` = baskets.id AND basket_id = ?', [$item->id]);
                if ($one!=[]){
                    $one[0]->product_id=$item->id;
                }
                $milk = DB::select('SELECT `milk_in_bask`.*, altmilks.name as name, baskets.id as bask FROM `milk_in_bask` INNER JOIN baskets INNER JOIN altmilks WHERE `milk_id` = altmilks.id AND `bask_id` = baskets.id AND bask_id = ?', [$item->id]);
                if ($milk!=[]){
                    $milk[0]->product_id=$item->id;
                }
            }
            return view('users.basket', compact('products', 'sum', 'ingr', 'one', 'milk'));
        }

        return view('users.basket', compact('products', 'sum'));

    }
    public function profil()
    {
        $id = session('id');
        $user = User::find($id);
        $ords = DB::select('SELECT `orders`.*, statuses.name as status FROM `orders` INNER JOIN statuses WHERE `status_id` = statuses.id AND `status_id` != 3 AND `users_id` = ?', [$id]);
        $items = DB::select('SELECT `product_in_order`.*, products.name as prod, products.photo, SUM(products.price * product_in_order.count) as sum FROM `product_in_order` INNER JOIN products WHERE product_id = products.id GROUP BY `product_in_order`.`id`');
        return view('users.profil', compact('user', 'ords', 'items'));
    }
    // public function redphoto()
    // {
    //     $id = session('id');
    //     $user = User::find($id);
    //     $photo = $user[0]->photo;
    // }
    public function updateCart($productId, $operation)
    {

        $user = session('id');

        // Находим товар в корзине пользователя
        $basket = Basket::where('products_id', $productId)
            ->where('users_id', $user)
            ->first();

        if (!$basket) {
            return response()->json(['success' => false, 'message' => 'Товар не найден'], 404);
        }

        // Обновляем количество товара в корзине в зависимости от операции
        $count = request()->input('count');
        if ($operation === 'plus') {
            $basket->count += $count;
        } elseif ($operation === 'minus') {
            $basket->count -= $count;
        }
        // dd($basket->count);

        // Сохраняем обновленное количество товара
        $basket->save();

        return response()->json(['success' => true, 'count' => $basket->count]);
    }

    public function removeFromCart($productId)
    {
        $user = session('id');

        // Находим товар в корзине пользователя и удаляем его
        Basket::where('products_id', $productId)
            ->where('users_id', $user)
            ->delete();

        return response()->json(['success' => true]);
    }
    private static function getParam($array, $value)
    {
        return implode(',', array_fill(0, count($array), $value));
    }
    public function order(Request $request)
    {
        // $date = Carbon::now()->subDays(7);
        $user = session('id');
        $orderNumber = time() . Str::random(6);
        $basket = DB::select('select * from baskets where users_id = ?', [$user]);
        $address = '';
        if($request->has('sam'))
        {
            $address = 'Карла Маркса 5';
        }
        else
        {
            $address = $request->address;
        }
        $order = DB::insert('insert into orders (adress, number, users_id, status_id) values (?, ?, ?, ?)', [$address, $orderNumber, $user, 1]);
        $orderid = DB::getPdo()->lastInsertId();
        $base = "INSERT INTO product_in_order (order_id, product_id, count) VALUES ";
        $bask = DB::select('SELECT `ing_in_bask`.*, baskets.users_id, baskets.products_id as prod FROM `ing_in_bask` INNER JOIN baskets WHERE basket_id = baskets.id AND baskets.users_id = ?', [$user]);
        $milk = DB::select('SELECT `milk_in_bask`.*, baskets.users_id, baskets.products_id as prod FROM `milk_in_bask` INNER JOIN baskets WHERE bask_id = baskets.id AND baskets.users_id = ?', [$user]);

        // $base2 = "INSERT INTO ing_in_order (ing_id, order_id) VALUES ";
        //формируем количество позиционных параметров в зависимости от кол-ва продуктов
        $params = self::getParam($basket, "(?, ?, ?)");

        //создали текст запроса, соединили 2 части
        $queryText = $base . $params;

        $values = [];

        //заполняем массив с значениями
        foreach ($basket as $item) {
            $values = array_merge($values, [$orderid, $item->products_id, $item->count]);
        }
        // dd($values);
        $query = DB::insert($queryText, $values);

        foreach($basket as $item)
        {
            $qr = DB::update('update products set count = count-? where id = ?', [$item->count, $item->products_id]);
        }
        Basket::where('users_id', $user)->delete();
        $gg = DB::select('select * from product_in_order where order_id = ?', [$orderid]);
        foreach ($bask as $b) {
            foreach ($gg as $item)
            {
                if($b->prod == $item->product_id)
                {
                    $pr = DB::insert('insert into ing_in_order (ing_id, order_id) values (?, ?)', [$b->ing_id, $item->id]);
                }

            }

        }
        foreach ($milk as $m) {

            foreach ($gg as $item)
            {
                if($m->prod == $item->product_id)
                {
                    $pr = DB::insert('insert into milk_in_order (milk_id, order_id) values (?, ?)', [$m->milk_id, $item->order_id]);
                }

            }

        }
        return redirect('/userorders');
    }
    public function userorders()
    {
        $user = session('id');
        $orders = DB::select('SELECT `orders`.*, statuses.name as status FROM `orders` INNER JOIN statuses WHERE statuses.id = status_id AND users_id = ? ORDER BY orders.created_at DESC', [$user]);
        $products = DB::select('SELECT
        `product_in_order`.*,
        products.name AS prod,
        products.photo,
        orders.id AS orderr,
        SUM(products.price * product_in_order.count) AS sum
      FROM
        `product_in_order`
      INNER JOIN products ON product_in_order.product_id = products.id
      INNER JOIN orders ON product_in_order.order_id = orders.id
      GROUP BY
        `product_in_order`.id');
        $ingridients = DB::select('SELECT `ing_in_order`.*, ingridients.name as ingr FROM `ing_in_order` INNER JOIN ingridients WHERE `ing_id` = ingridients.id');
        $milks = DB::select('SELECT `milk_in_order`.*, altmilks.name as milk FROM `milk_in_order` INNER JOIN altmilks WHERE `milk_id` = altmilks.id');
        return view('users.orders', compact('orders', 'products', 'ingridients', 'milks'));

    }
    public function userreview(){
        $user = session('id');
        $reviews = DB::select('SELECT `reviews`.*, products.name as prod FROM `reviews` INNER JOIN products WHERE product_id = products.id AND `user_id` = ?', [$user]);
        return view('users.userreview', compact('reviews'));
    }
    public function sorglas()
    {
        return view('sorglas');
    }

}
