<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Altmilk;
use App\Models\Category;
use App\Models\IngInProd;
use App\Models\Ingridient;
use App\Models\Milk;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;
use Spatie\Backtrace\Arguments\ReduceArgumentsAction;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
            $ad = DB::select('select * from admins where name = ? and password = ?', [$request->name, $request->password]);
            if($ad != [])
            {
                $request->session()->put('admin', 1);
                return redirect('/product');
            }
            else
            {
                return redirect('/index');
            }


    }
    public function sinad()
    {
        return view('admins.admin');
    }
    //категории
    public function allcat()
    {
        if(session('admin') == 1)
        {
            $categories = Category::all();
            return view('admins.category', compact('categories'));
        }
        else
        {
            return redirect('/');
        }

    }
    public function redcat(Request $request, $id)
    {
        if(session('admin') == 1)
        {
            $review = Category::findOrFail($id);
            // Обновляем содержимое отзыва
            $review->name = $request->input('content');

            // Сохраняем обновленный отзыв
            $review->save();

            // Возвращаем ответ клиенту (например, подтверждение об успешном обновлении)
            return response()->json(['message' => 'Отзыв успешно обновлен'], 200);
        }
        else
        {
            return redirect('/');
        }

    }
    public function addcat(Request $request)
    {
        if(session('admin') == 1)
        {
            $cat = DB::insert('insert into categories (name) values (?)', [$request->name]);
            if ($cat)
            {
                return redirect('/category');
            }
        }
        else
        {
            return redirect('/');
        }

    }
    public function delcat(Request $request)
    {
        if(session('admin') == 1)
        {
            $id = $request->id;
            $del = Category::find($id)->delete();
            return redirect('/category');
        }
        else
        {
            return redirect('/');
        }

    }
    //продукты
    public function allprod()
    {

        if(session('admin') == 1)
        {
            $products = DB::select('SELECT `products`.*, categories.id as catId, categories.name as category FROM `products` INNER JOIN categories WHERE categories.id = category_id');
            return view('admins.product', compact('products'));
        }
        else
        {
            return redirect('/');
        }

    }
    public function addp()
    {
        if(session('admin') == 1)
        {
            $categories = Category::all();
            return view('admins.addprod', compact('categories'));
        }
        else
        {
            return redirect('/');
        }

    }
    public function addprod(Request $request){
        if(session('admin') == 1)
        {
            $exseption = '';
        $newName = '';
        if(isset($request->btn))
        {
            $extensions = ['jpeg', 'jpg', 'png', 'webp', 'jfif'];
            $types = ["image/jpg", "image/png", "image/jpeg", "image/webp", "image/jfif"];
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $size = $file->getSize();
                $newName = time() . "_" . $file->getClientOriginalName();

                if (in_array($file->getMimeType(), $types)) {
                    if ($size > 4097152) {
                        $exseption = "Файл слишком большой";
                    } else {
                        // Успешно сохраненный путь к файлу
                        $file->move(public_path('image'), $newName);
                    }
                } else {
                    $exseption = "Неправильное расширение файла. Выберите файлы с расширением: " . implode(", ", $extensions);
                }
            } else {
                $exseption = "Файл не загружен";
            }


            if (empty($exseption) ) {
                $upd = DB::insert('insert into products (name, count, price, description, structure, callories, bgu, photo, category_id) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->name, $request->count, $request->price, $request->description, $request->structure, $request->callories, $request->bgu, $newName, $request->cat]);
                if($upd)
                {
                    return redirect('/product');
                }

            } else {
                return redirect('/product');
                // $id = $request->id;
                // $product = DB::select('SELECT `products`.*, categories.id as catId, categories.name as category FROM `products` INNER JOIN categories WHERE categories.id = category_id and products.`id` = ?', [$id]);
                // $categories = Category::all();
                // return view('admins.addprod', compact('product', 'categories', 'exseption'));
            }
        }
        else {
            dd(11111);
        }
        }
        else
        {
            return redirect('/');
        }


    }

    public function redp(Request $request){
        if(session('admin') == 1)
        {
            $id = $request->btn;
            $product = DB::select('SELECT `products`.*, categories.id as catId, categories.name as category FROM `products` INNER JOIN categories WHERE categories.id = category_id and products.`id` = ?', [$id]);
            $categories = Category::all();

            $product = $product[0];
            return view('admins.redprod', compact('product', 'categories', ));
        }
        else
        {
            return redirect('/');
        }

    }
    public function redprod(Request $request)
    {
        if(session('admin') == 1)
        {
            $newName = '';
            if(isset($request->btn))
            {
                $name = $request->photoi;
                $exseption = '';
                $extensions = ['jpeg', 'jpg', 'png', 'webp', 'jfif'];
                $types = ["image/jpg", "image/png", "image/jpeg", "image/webp", "image/jfif"];

                if ($request->hasFile('photo')) {
                    $file = $request->file('photo');
                    $size = $file->getSize();
                    $newName = time() . "_" . $file->getClientOriginalName();

                    if (in_array($file->getMimeType(), $types)) {
                        if ($size > 4097152) {
                            $exseption = "Файл слишком большой";
                        } else {
                            // unlink(public_path("image/$name"));
                            // Успешно сохраненный путь к файлу
                            $file->move(public_path('image'), $newName);
                        }
                    } else {
                        $exseption = "Неправильное расширение файла. Выберите файлы с расширением: " . implode(", ", $extensions);
                    }
                } else {
                    $upd = DB::update('UPDATE products SET `name` = ?, `count` = ?, `price` = ?, `description` = ?, `structure` = ?, `callories` = ?, `bgu` = ?, photo = ?, `category_id` = ? where id = ?', [$request->name, $request->count, $request->price, $request->description, $request->structure, $request->callories, $request->bgu, $request->photoi, $request->cat, $request->btn]);
                    return redirect('/product');
                }

                if ($exseption == '') {
                    // dd($newName);
                    $upd = DB::update('UPDATE products SET `name` = ?, `count` = ?, `price` = ?, `description` = ?, `structure` = ?, `callories` = ?, `bgu` = ?, photo = ?, `category_id` = ? where id = ?', [$request->name, $request->count, $request->price, $request->description, $request->structure, $request->callories, $request->bgu, $newName, $request->cat, $request->btn]);
                    return redirect('/product');

                }
                else
                {
                    dd($exseption);
                }
            }
            else
            {
                dd(1111);
            }
        }
        else
        {
            return redirect('/');
        }


    }
    public function delprod(Request $request)
    {
        if(session('admin') == 1)
        {
            $id = $request->id;
            $del = Product::find($id)->delete();
            return redirect('/product');
        }
        else
        {
            return redirect('/');
        }

    }

    //ингридиенты
    public function alling()
    {
        if(session('admin') == 1)
        {
            $ings = Ingridient::all();
            return view('admins.ingridient', compact('ings'));
        }
        else
        {
            return redirect('/');
        }

    }

    public function adding(Request $request)
    {
        if(session('admin') == 1)
        {
            $name = $request->name;
            $price = $request->price;
            $add = DB::insert('insert into ingridients (name, price) values (?, ?)', [$name, $price]);
            return redirect('/ingridients');
        }
        else
        {
            return redirect('/');
        }

    }
    public function reding(Request $request, $id)
    {
        if(session('admin') == 1)
        {
            $review = Ingridient::findOrFail($id);
            // Обновляем содержимое отзыва
            $review->name = $request->input('content');

            // Сохраняем обновленный отзыв
            $review->save();

            // Возвращаем ответ клиенту (например, подтверждение об успешном обновлении)
            return response()->json(['message' => 'Отзыв успешно обновлен'], 200);
        }
        else
        {
            return redirect('/');
        }

    }
    public function redingprod()
    {
        if(session('admin') == 1)
        {
            return view('admins.inginprod');
        }
        else
        {
            return redirect('/');
        }

    }
    public function deling(Request $request)
    {
        if(session('admin') == 1)
        {
            $id = $request->id;
            $del = Ingridient::find($id)->delete();
            return redirect('/ingridients');
        }
        else
        {
            return redirect('/');
        }

    }
    //
    public function allingprod(){
        if(session('admin') == 1)
        {
            $ings = Ingridient::all();
            $products = Product::all();
            $items = DB::select('SELECT `ing_in_prods`.*, products.name AS product, ingridients.name as ingridident FROM `ing_in_prods` INNER JOIN products INNER JOIN ingridients WHERE products.id = product_id AND ingridients.id = ingridient_id');
            return view('admins.inginprod', compact('ings', 'products', 'items'));
        }
        else
        {
            return redirect('/');
        }

    }
    public function addingprod(Request $request){
        if(session('admin') == 1)
        {
            $br = DB::insert('insert into ing_in_prods (ingridient_id, product_id) values (?, ?)', [$request->ing, $request->product]);
            return redirect('/allingprod');
        }
        else
        {
            return redirect('/');
        }

    }
    public function delingprod(Request $request)
    {
        if(session('admin') == 1)
        {
            $id = $request->id;
            $del = IngInProd::find($id)->delete();
            return redirect('/allingprod');
        }
        else
        {
            return redirect('/');
        }

    }
    // orders
    public function admorders()
    {
        if(session('admin') == 1)
        {
            $orders = DB::select('SELECT `orders`.*, users.name AS user, statuses.name as status FROM `orders` INNER JOIN users INNER JOIN statuses WHERE status_id = statuses.id AND users_id = users.id');
            $statuses = Status::all();
            return view('admins.order', compact('orders', 'statuses'));
        }
        else
        {
            return redirect('/');
        }

    }
    public function changeStatus(Request $request)
    {
        if(session('admin') == 1)
        {
            // Retrieve data from the request
            $orderId = $request->input('order_id');
            $newStatus = $request->input('new_status');

            // Find the order by its ID
            $order = Order::find($orderId);

            if ($order) {
                // Update the order status
                $order->status_id = $newStatus;
                $order->save();

                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'error' => 'Order not found'], 404);
            }
        }
        else
        {
            return redirect('/');
        }

    }

    public function delord(Request $request){
        if(session('admin') == 1)
        {
            $id = $request->id;
            $del = Order::find($id)->delete();
            return redirect('/admorders');
        }
        else
        {
            return redirect('/');
        }

    }
    // review
    public function reviewadm(){
        if(session('admin') == 1)
        {
            $reviews = DB::select('SELECT `reviews`.*, products.name as product, users.name as user FROM `reviews` INNER JOIN products INNER JOIN users WHERE `product_id` = products.id AND `user_id` = users.id');
            $reviewshid = DB::select('SELECT `reviews`.*, products.name as product, users.name as user FROM `reviews` INNER JOIN products INNER JOIN users WHERE `product_id` = products.id AND `user_id` = users.id AND hidden = 1');
            return view('admins.review', compact('reviews', 'reviewshid'));
        }
        else
        {
            return redirect('/');
        }

    }
    public function delreview(Request $request){
        if(session('admin') == 1)
        {
            $id = $request->id;
            $del = Review::find($id)->delete();
            return redirect('/reviewadm');
        }
        else
        {
            return redirect('/');
        }

    }
    // user
    public function user() {
        if(session('admin') == 1)
        {
            $users = User::all();
            return view('admins.user', compact('users'));
        }
        else
        {
            return redirect('/');
        }

    }
    public function deluser(Request $request){
        if(session('admin') == 1)
        {
            $id = $request->id;
            $del = User::find($id)->delete();
            return redirect('/user');
        }
        else
        {
            return redirect('/');
        }

    }
    // status
    public function status(){
        if(session('admin') == 1)
        {
            $statuses = Status::all();
            return view('admins.status', compact('statuses'));
        }
        else
        {
            return redirect('/');
        }

    }

    public function update(Request $request, $id)
    {
        if(session('admin') == 1)
        {
            // Проверяем существование отзыва
        $review = Status::findOrFail($id);
        // Обновляем содержимое отзыва
        $review->name = $request->input('content');

        // Сохраняем обновленный отзыв
        $review->save();

        // Возвращаем ответ клиенту (например, подтверждение об успешном обновлении)
        return response()->json(['message' => 'Отзыв успешно обновлен'], 200);
        }
        else
        {
            return redirect('/');
        }

    }
    public function delstatus(Request $request){
        if(session('admin') == 1)
        {
            $id = $request->id;
            $del = Status::find($id)->delete();
            return redirect('/status');
        }
        else
        {
            return redirect('/');
        }

    }
    public function addstatus(Request $request)
    {
        if(session('admin') == 1)
        {
            $cat = DB::insert('insert into statuses (name) values (?)', [ $request->name]);
            if ($cat)
            {
                return redirect('/status');
            }
        }
        else
        {
            return redirect('/');
        }

    }
    // admins
    public function admins() {
        if(session('admin') == 1)
        {
            $admins = Admin::all();
            return view('admins.admins', compact('admins'));
        }
        else
        {
            return redirect('/');
        }

    }
    public function addadmin(Request $request) {
        if(session('admin') == 1)
        {
            $a = DB::insert('insert into admins (name, password) values (?, ?)', [$request->name, Hash::make($request->password)]);
            return redirect('/admins');
        }
        else
        {
            return redirect('/');
        }

    }
    public function deladmin(Request $request)
    {
        if(session('admin') == 1)
        {
            $id = $request->id;
            $del = Admin::find($id)->delete();
            return redirect('/admins');
        }
        else
        {
            return redirect('/');
        }

    }
    public function reportnone(Request $request){
        if(session('admin') == 1)
        {
            $review = Review::findOrFail($request->id);
            // Обновляем содержимое отзыва
            $review->hidden = 0;

            // Сохраняем обновленный отзыв
            $review->save();
            return redirect('/reviewadm');
        }
        else
        {
            return redirect('/');
        }

    }
    public function getStatuses()
    {
        if(session('admin') == 1)
        {
            $statuses = Status::all(); // Получаем все статусы из базы данных
            return response()->json($statuses); // Возвращаем статусы в формате JSON
        }
        else
        {
            return redirect('/');
        }

    }

    // Метод для получения данных таблицы
    public function getData()
    {
        if(session('admin') == 1)
        {
            $data = DB::select('SELECT `orders`.*, users.name AS user, statuses.name as status FROM `orders` INNER JOIN users INNER JOIN statuses WHERE status_id = statuses.id AND users_id = users.id');
            return response()->json($data, 200); // Возвращаем данные таблицы в формате JSON
        }
        else
        {
            return redirect('/');
        }
    }
    public function currents()
    {
        if(session('admin') == 1)
        {
            $products = Product::all();
            $currents = DB::select('SELECT `current`.*, products.id as pr_id, products.name FROM `current` INNER JOIN products WHERE products.id = product_id');
            return view('admins.current', compact('products', 'currents'));
        }
        else
        {
            return redirect('/');
        }
    }
    public function aexit()
    {
        if(session('admin') == 1)
        {
            Session::forget('admin');
            return redirect('/');
        }
        else
        {
            return redirect('/');
        }

    }
    public function addcurrent(Request $request) {
        if(session('admin') == 1)
        {
            $id = DB::select('select * from products where name = ?', [$request->prod]);
            $query = DB::insert('insert into current (product_id) values (?)', [$id[0]->id]);
            if($query)
            {
                return redirect('/currents');
            }
            else
            {
                return redirect('/currents');
            }
        }
        else
        {
            return redirect('/');
        }
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('products.name', 'LIKE', "%{$query}%")
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category')
        ->get();
        // $products = Product::where('name', 'LIKE', "%{$query}%")->get()
        // ->join('categories', 'products.category_id', '=', 'categories.id')
        // ->select('products.*', 'categories.name as category_name')
        // ->get();
        return response()->json($products);
    }
    public function redmilk(Request $request, $id)
    {
        if(session('admin') == 1)
        {
            $review = Altmilk::find($id);
            // Обновляем содержимое отзыва
            $review->name = $request->input('content');

            // Сохраняем обновленный отзыв
            $review->save();

            // Возвращаем ответ клиенту (например, подтверждение об успешном обновлении)
            return response()->json(['message' => 'Отзыв успешно обновлен'], 200);
        }
        else
        {
            return redirect('/');
        }

    }
    public function milks()
    {
        if(session('admin') == 1)
        {
            $milks = DB::select('select * from altmilks');
            return view('/admins.milk', compact('milks'));
        }
        else
        {
            return redirect('/');
        }

    }
    public function addmilk(Request $request)
    {
        if(session('admin') == 1)
        {
            $milk = DB::insert('insert into altmilks (name) values (?)', [$request->name]);
            if ($milk)
            {
                return redirect('/milks');
            }
        }
        else
        {
            return redirect('/');
        }

    }
    public function delmilk(Request $request)
    {
        if(session('admin') == 1)
        {
            $id = $request->id;
            $del = Altmilk::find($id)->delete();
            return redirect('/milks');
        }
        else
        {
            return redirect('/');
        }

    }
    public function delcurrent(Request $request)
    {
        if(session('admin') == 1)
        {
            $id = $request->id;
            $del = DB::delete('delete from current where id = ?', [$id]);
            return redirect('/currents');
        }
        else
        {
            return redirect('/');
        }

    }

}
