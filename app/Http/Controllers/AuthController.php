<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Customer;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect('customer');
        }
        else if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('admin/index');
        }
        else {
            return redirect()->back()->with('error', 'Wrong email or password');;
        }
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
			'email' => 'email',
			'password' => 'required|between:6,255|confirmed',
			'confirm_password' => 'required',
		]);

        if ($request->get('password') != $request->get('confirm_password')) {
            return redirect()->back()->withErrors(['msg' => 'Password is not match !']);
        }

		$email = $request->get('email');
		$customer = Customer::where('email', $email)->first();

        if ($customer) {
			return redirect()->back()->withErrors(['msg' => 'This email already register']);
		}

        $customer->email = $request->get('email');
		$customer->password = Hash::make($request->password);
		$customer->save();

		return redirect('/login')->with('success', 'Register success !');
    }

    public function adminLogout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
