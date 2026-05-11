<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;

class AuthController extends Controller
{

    /**
     * @throws BindingResolutionException
     */
    public function showLoginForm()
    {
        return view('components.auth.login');
    }

    public function login()
    {

    }

    /**
     * @throws BindingResolutionException
     */
    public function showRegistrationForm()
    {
        return view('components.auth.register');
    }

    public function register()
    {

    }

    public function logout()
    {

    }
}
