<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $number = $request->number;
        $password = $request->password;
        $pattern = '/((?=.*\\d)(?=.*[[:lower:]]) (?=.*[[:upper:]]).{6,20})/';
        $error = '';
        $signup = false;
        if(empty($name) || empty($email) || empty($number) || empty($password))
        {
            $error . 'Поля не должны быть пустыми! ';
        }
        if(strlen($name) < 10)
        {
            $error . 'ФИО должно быть больше 15 символов! ';
        }
        if(!preg_match($pattern, $password))
        {
            $error . 'Пароль должен быть не менее 6 символов, содержать буквы из верхнего и нижнего регистра, одну цифру! ';
        }
        if($error == '')
        {

            $find = DB::select('select * from users where number = ?', [$number]);
            if($find != [])
            {
                $error . 'Номер уже зарегистрирован';
                return view('users.auth', compact('name', 'email', 'number', 'error'));
            }
            else {

                $query = DB::insert('insert into users (`name`, `number`, `email`, `password`, `photo`) values (?, ?, ?, ?, ?)', [$name, $number, $email, Hash::make($password), 'ggg']);
                if($query)
                {
                    $find = DB::select('select * from users where number = ?', [$number]);
                    $signup = true;
                    $request->session()->put('id', $find[0]->id);
                    return view('welcome', compact('signup'));
                }
                return view('users.auth', compact('name', 'email', 'number', 'error'));
            }


        }
        else {
            return view('users.auth', compact('name', 'email', 'number', 'error'));
        }
    }
    public function signin(Request $request)
    {
        $number = $request->number;
        $password = $request->password;
        $error = '';
        $signup = false;
        if( empty($number) || empty($password))
        {
            $error . 'Поля не должны быть пустыми! ';
        }
        if($error == '')
        {
            $query = DB::select('select * from users where number = ?', [$number]);
            if($query != [])
            {
                if (Hash::check($password, $query[0]->password)) {
                    $signup += true;
                    session(['id' => $query[0]->id]);
                    return redirect('/');
                }
                else {
                    return view('users.auth', compact('name', 'email', 'number', 'error'));
                }

            }
            else {
                return view('users.auth', compact('name', 'email', 'number', 'error'));
            }
        }
        else {
            return view('users.auth', compact('name', 'email', 'number', 'error'));
        }
    }
}
//
