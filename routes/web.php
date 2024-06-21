<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [MenuController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/menu', [MenuController::class, 'categories'])->name('menu');
Route::get('/auth', function () {
    return view('users.auth');
})->name('auth');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::get('/addbask', [MenuController::class, 'addbask'])->name('addbask');
Route::get('/basket', [MainController::class, 'basket'])->name('basket');
Route::get('/show', [MenuController::class, 'show'])->name('show');
Route::get('/profil', [MainController::class, 'profil'])->name('profil');
Route::put('/update-cart/{productId}/{operation}', [MainController::class, 'updateCart']);
Route::delete('/remove-from-cart/{productId}', [MainController::class, 'removeFromCart']);
Route::post('order', [MainController::class, 'order'])->name('order');
Route::get('/userorders', [MainController::class, 'userorders'])->name('userorders');
Route::get('/review', [MenuController::class, 'review'])->name('review');
Route::put('/update-review/{id}', [MenuController::class, 'update'])->name('reviews.update');
Route::get('/delrev', [MenuController::class, 'delrev'])->name('delrev');
Route::get('/userreview', [MainController::class, 'userreview'])->name('userreview');
Route::get('/filters', [MenuController::class, 'filters'])->name('filters');
Route::get('/sorglas', [MainController::class, 'sorglas'])->name('sorglas');
Route::get('/log', function () {
    Session::flush();
    return redirect('/');
})->name('log');
Route::get('/redprof', [AuthController::class, 'redprof'])->name('redprof');
Route::post('/redprofil', [AuthController::class, 'redprofil'])->name('redprofil');
Route::get('/report', [MenuController::class, 'report'])->name('report');

//admins
Route::get('/category', [AdminController::class, 'allcat'])->name('allcat');
Route::get('/redcat', [AdminController::class, 'redcat'])->name('redcat');
Route::get('/addcat', [AdminController::class, 'addcat'])->name('addcat');
Route::delete('/delcat', [AdminController::class, 'delcat'])->name('delcat');
Route::get('/product', [AdminController::class, 'allprod'])->name('allprod');
Route::post('/redprod', [AdminController::class, 'redprod'])->name('redprod');
Route::get('/redp', [AdminController::class, 'redp'])->name('redp');
Route::post('/addprod', [AdminController::class, 'addprod'])->name('addprod');
Route::get('/addp', [AdminController::class, 'addp'])->name('addp');
Route::get('/delprod', [AdminController::class, 'delprod'])->name('delprod');
Route::post('/admin', [AdminController::class, 'admin'])->name('admin');
Route::get('/sinad', [AdminController::class, 'sinad'])->name('sinad');
Route::get('/ingridients', [AdminController::class, 'alling'])->name('alling');
Route::get('/adding', [AdminController::class, 'adding'])->name('adding');
Route::get('/redingprod', [AdminController::class, 'redingprod'])->name('redingprod');
Route::post('/deling', [AdminController::class, 'deling'])->name('deling');
Route::get('/addingprod', [AdminController::class, 'addingprod'])->name('addingprod');
Route::get('/allingprod', [AdminController::class, 'allingprod'])->name('allingprod');
Route::get('/delingprod', [AdminController::class, 'delingprod'])->name('delingprod');
Route::get('/admorders', [AdminController::class, 'admorders'])->name('admorders');
Route::post('/changeStatus', [AdminController::class, 'changeStatus'])->name('changeStatus');
Route::delete('/delord', [AdminController::class, 'delord'])->name('delord');
Route::get('/reviewadm', [AdminController::class, 'reviewadm'])->name('reviewadm');
Route::delete('/delreview', [AdminController::class, 'delreview'])->name('delreview');
Route::get('/user', [AdminController::class, 'user'])->name('user');
Route::delete('/deluser', [AdminController::class, 'deluser'])->name('deluser');
Route::get('/status', [AdminController::class, 'status'])->name('status');
Route::delete('/delstatus', [AdminController::class, 'delstatus'])->name('delstatus');
Route::put('/update-status/{id}', [AdminController::class, 'update'])->name('reviews.update');
Route::post('/addstatus', [AdminController::class, 'addstatus'])->name('addstatus');
Route::get('/admins', [AdminController::class, 'admins'])->name('admins');
Route::post('/addadmin', [AdminController::class, 'addadmin'])->name('addadmin');
Route::delete('/deladmin', [AdminController::class, 'deladmin'])->name('deladmin');
Route::put('/update-cat/{id}', [AdminController::class, 'redcat'])->name('redcat');
Route::put('/update-ing/{id}', [AdminController::class, 'reding'])->name('reding');
Route::get('/reportnone', [AdminController::class, 'reportnone'])->name('reportnone');
Route::get('/statuses', [AdminController::class, 'getStatuses'])->name('getStatuses');
Route::get('/currents', [AdminController::class, 'currents'])->name('currents');
Route::post('/addcurrent', [AdminController::class, 'addcurrent'])->name('addcurrent');
Route::delete('/delcurrent', [AdminController::class, 'delcurrent'])->name('delcurrent');
Route::get('/aexit', [AdminController::class, 'aexit'])->name('aexit');
Route::get('/data', [AdminController::class, 'getData'])->name('getData');
Route::get('/konf', function () {
    return view('konf');
})->name('konf');
Route::get('/search', [AdminController::class, 'search'])->name('search');
Route::put('/update-milk/{id}', [AdminController::class, 'redmilk'])->name('redmilk');
Route::get('/milks', [AdminController::class, 'milks'])->name('milks');
Route::get('/addmilk', [AdminController::class, 'addmilk'])->name('addmilk');
Route::delete('/delmilk', [AdminController::class, 'delmilk'])->name('delmilk');
