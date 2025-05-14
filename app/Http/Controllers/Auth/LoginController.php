<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
        public function showLoginForm()
        {
            return view('auth.login');
        }
    
        public function login(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('login')
                                 ->withErrors($validator)
                                 ->withInput();
            }
    
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->intended('/home');
            }
    
            return redirect()->route('login')->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    
        public function logout()
        {
            Auth::logout();
            return redirect()->route('login');
        }
}
