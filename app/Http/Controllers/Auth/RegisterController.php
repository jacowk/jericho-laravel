<?php

namespace jericho\Http\Controllers\Auth;

use jericho\User;
use Validator;
use jericho\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|max:255',
        	'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:8|confirmed|case_diff|numbers|letters|symbols'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
        	'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        	'pagination_size' => '10',
        	'created_by_id' => '1' /* Default value is 1 - Web Master - for user registration */
        ]);
    }
}
