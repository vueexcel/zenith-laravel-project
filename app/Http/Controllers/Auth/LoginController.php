<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username() {
        return 'member_no';
    }

    public function guest_login(\Illuminate\Http\Request $request)
    {
        $guest_no = $request->get('guest_user_no');
        $user = User::where('member_no', $guest_no)->first();
        if(empty($user)) {
            $errors = new MessageBag(['guest_user_no' => ['Member is not exist.']]);
            return Redirect::back()->withErrors($errors)->withInput(Input::except('guest_user_no'));
        }
        else {
            $request->merge([
                'member_no' => trim($user->member_no),
                'password' => '12345678'
            ]);
            $this->login($request);
            return redirect('/dashboard');
        }
    }
}
