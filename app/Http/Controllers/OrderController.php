<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Basket;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function index()
    {
        $indexes = DB::select('SELECT * FROM `texts` WHERE `page` = ?', [1]);
        return view('welcome', compact('indexes'));
    }
    public function store(Request $request)
    {

        $categories = Category::all();
        $item = 0;
        if(isset($_GET['filtr']))
        {
            $filter = $request->fll;
            $filter == 'ASC' ? $item = 1 : $item = 2;
            $products = DB::select('select * from products ORDER BY price ' . $filter);

        }
        else
        {
            $products = Product::all();
        }
        return view('products.catologs', compact('categories', 'products', 'item'));
    }
    public function filters(Request $request)
    {
        if(isset($_GET['filtr']))
        {
            $filter = $request->fll;
            $products = DB::select('select * from products ORDER BY price ' + $filter);

        }
        else
        {
            $products = Product::all();
        }
        return view('products.catologs', compact('products'));

    }
    public function create(Request $request)
    {
        $id = $request->id;
        $price = $request->price;
        $user =  session('id');
        $ing = $request->ing;
        $prod = DB::select('select * from baskets where products_id = ? AND users_id = ?', [$id, $user]);
        $bask = 0;
        if($prod == [])
        {
            $query = DB::insert('insert into baskets (count, products_id, price, users_id) values (?, ?, ?, ?)', [1, $id, $price, $user]);
            $bask = DB::getPdo()->lastInsertId();
        }
        else {
            $query = DB::update('update baskets set count = count + 1 where products_id = ?', [$id]);
            $bask = $prod[0]->id;
        }
        if (isset ($ing)) {
            foreach ($ing as $i) {
                $ingir = DB::insert('INSERT INTO ing_in_bask (`ing_id`, basket_id) VALUES (?, ?)', [$i, $bask]);
            }

        }
        if($query)
        {
            return redirect('/menu');
        }

    }
    public function show(Request $request)
    {
        $user = session('id');
        $id = $request->id;
        if($request->id == null)
        {
            $id = $request->input('id');
        }
        $product = Product::find($id);
        $ingridients = DB::select('SELECT `ing_in_prods`.*, ingridients.name, ingridients.id as ing, ingridients.price FROM `ing_in_prods` INNER JOIN ingridients WHERE ingridients.id = `ingridient_id` AND `product_id` = ?', [$id]);
        $uss = 1;
        $query = DB::select('SELECT `product_in_order`.*, orders.users_id as user, orders.id AS orderr FROM `product_in_order` INNER JOIN orders WHERE  orders.id = `order_id` AND orders.users_id = ? AND `product_id` = ?', [$user, $id]);
        $guert = DB::select('SELECT * FROM `reviews` WHERE `user_id` = ? AND `product_id` = ?', [$user, $id]);
        if($query == [] || $guert != [])
        {
            $uss = 0;
        }
        $reviews = DB::select('SELECT reviews.*, users.name as user FROM reviews INNER JOIN users WHERE user_id = users.id AND `product_id` = ?', [$id]);
        return view('products.show', compact('product', 'ingridients', 'uss', 'reviews'));

    }
    public function review(Request $request)
    {

        $date = Carbon::now()->subDays(7);
        $user = session('id');
        $query = DB::insert('INSERT INTO `reviews` (`text`, `product_id`, `user_id`, created_at) values (?, ?, ?, ?)', [$request->review, $request->btn, $user, $date]);
        return redirect()->route('show', ['id' => $request->btn]);
    }
    // public function uprev(Request $request)
    // {
    //     $user = session('id');
    //     $rev = DB::update('update reviews set text = ? where user_id = ? and product_id = ?', [$request->red, $user, ]);
    // }
    public function edit(Request $request, $id)
    {
        // Проверяем существование отзыва
        $review = Review::findOrFail($id);
        // Обновляем содержимое отзыва
        $review->text = $request->input('content');

        // Сохраняем обновленный отзыв
        $review->save();

        // Возвращаем ответ клиенту (например, подтверждение об успешном обновлении)
        return response()->json(['message' => 'Отзыв успешно обновлен'], 200);
    }
    public function destroy(Request $request)
    {
        $user = session('id');
        // Находим товар в корзине пользователя и удаляем его
        Review::where('id', $request->del)->delete();

        return redirect()->route('show', ['id' => $request->btn]);
    }
}
//
