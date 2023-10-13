<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\RegistrationUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.sign-up.sign-up');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrationUserRequest $request): RedirectResponse
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('home')->with('success', __('user.signup'));
    }

    public function loginForm()
    {
        return view('user.sign-in.sign-in');
    }

    public function login(AuthUserRequest $request): RedirectResponse
    {
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->back()->withInput()->withErrors(['login' => 'Неверный email или пароль']);
        }
        return redirect()->route('home')->with('success', __('user.signin'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
