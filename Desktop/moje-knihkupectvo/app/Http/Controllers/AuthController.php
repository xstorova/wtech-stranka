<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\CartController;

class AuthController extends Controller {
    
    public function showLogin() {
        return view('login');
    }
    
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // PRENOSITEĽNOSŤ KOŠÍKA: Pre prihláseného používateľa prenesieme session košík do DB
            CartController::mergeSessionCartOnLogin();
            
            return redirect()->intended('/');
        }
        
        return back()->withErrors(['email' => 'Nesprávne prihlasovacie údaje']);
    }
    
    public function showRegister() {
        return view('registration');
    }
    
    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        
        Auth::login($user);
        
        // PRENOSITEĽNOSŤ KOŠÍKA: Pre novo-registrovaného používateľa prenesieme session košík do DB
        CartController::mergeSessionCartOnLogin();
        
        return redirect('/');
    }
    
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Po odhlásení vymažeme session košík (prihlásený používateľ má košík v DB)
        session()->forget('cart');
        
        return redirect('/');
    }
}