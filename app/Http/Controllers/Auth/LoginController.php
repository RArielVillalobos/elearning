<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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

    public function logout(Request $request)
    {
        auth()->logout();
        //eliminar sesion
        session()->flush();
        return redirect('/login');
    }

    //esta funcion va a redirigir al metodo handle
    public function redirectToProvider(string $driver){
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback(string $driver){
        if(!request()->has('code')|| request()->has('denied')){
            session()->flash('message',['danger',__("inicio de sesion cancelado")]);
            return redirect('login');
        }
        $socialUser=Socialite::driver($driver)->user();

    }


}
