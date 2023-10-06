<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(): View|Factory|Application
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        if(!auth()->attempt($request->validated())){
            return back()->withErrors([
                'email' => 'Пользователь не найден, либо пароль не совподает',
            ]);
        }

        return redirect()->route('articles.index');
    }

    public function register(): View|Factory|Application
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse 
    {
        User::query()->create([
            'name' => $request->get('email'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        return redirect()->route('login');
    }

    public function logout(): RedirectResponse 
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
