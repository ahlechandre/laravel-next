<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * 
     * @return Response
     */
    public function login() 
    {
        return view('user::pages.auth.login');
    }

    /**
     * 
     * @param Request $request
     * @return Response
     */
    public function authenticate(Request $request) 
    {
        dd($request->all());
    }

    /**
     * 
     * @return Response
     */
    public function logout() 
    {
        Auth::logout();

        return redirect('/login')
            ->with('status', 'Faça login para continuar');
    }
}
