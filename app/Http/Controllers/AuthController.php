<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;
use function back;

class AuthController extends Controller
{

    /**
     * @throws BindingResolutionException
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * @throws Throwable
     */
    public function login(LoginRequest $request): RedirectResponse
    {

        if (Auth::attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['email' => 'These credentials do not match our records']);
    }

    /**
     * @throws BindingResolutionException
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register()
    {

    }

    public function logout()
    {

    }
}
