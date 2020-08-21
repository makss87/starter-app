<?php

namespace App\Controllers;


use App\Exceptions\AuthenticationException;
use App\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $request->validate(['login' => 'required', 'password' => 'required']);


        if ($request->get('login') != config('auth_login') || $request->get('password') != config('auth_password')) {
            throw new AuthenticationException('Wrong credentials');
        }

        session()->set('authenticated', true);

        $this->redirect('/');
    }

    public function logout()
    {
        session()->invalidate();
        session()->clear();

        $this->redirect('/');
    }
}