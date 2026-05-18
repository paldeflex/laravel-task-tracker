<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use RateLimiter;
use Throwable;
use function back;
use function strtolower;

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

        return back()->withInput()->withErrors(['email' => 'These credentials do not match our records']);
    }

    /**
     * @throws BindingResolutionException
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]
        );

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function logout()
    {

    }
}
