<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $redirectAfterLogin = RouteServiceProvider::HOME;
        $role = Auth::user()->role;
        switch ($role) {
            case 'admin':
                $redirectAfterLogin = $redirectAfterLogin;
            break;

            case 'sub-admin':
                $redirectAfterLogin = '/shipping';
            break;
        }

        return redirect()->intended($redirectAfterLogin);
    }

    public function destroy()
    {
        Helper::logout();

        return redirect('/');
    }
}
