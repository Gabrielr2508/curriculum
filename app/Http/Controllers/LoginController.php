<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
	public function authenticate(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required|min:6'
		]);

		$credentials = $request->only('email', 'password');

		if (auth()->attempt($credentials)) {
			return response('Login success', 200);
		}

		return response('Failed login', 401);
	}

	public function logout()
	{
		auth()->logout();
		return response('Logout success', 200);
	}
}