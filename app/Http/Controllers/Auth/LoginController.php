<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\User;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    
    public function redirectToSocial($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleSocialCallback($driver)
    {
        try
        {
            $social_user = Socialite::driver($driver)->user();
            $user = User::where('email', '=', $social_user->getEmail())->first();
            if (!is_null($user)) {
                Auth::login($user);
                return redirect($this->redirectPath());
            } else {
                return redirect()->back()->withErrors(trans('auth.failed'));
            }
        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }
}
