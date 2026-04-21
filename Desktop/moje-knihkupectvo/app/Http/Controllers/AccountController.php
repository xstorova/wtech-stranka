<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller {
    
    public function show() {
        return view('account');
    }
    
    public function update(Request $request) {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id
        ]);
        
        $user->update($data);
        return back()->with('success', 'Údaje uložené');
    }
    
    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);
        
        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Nesprávne heslo']);
        }
        
        $user->update(['password' => Hash::make($request->new_password)]);
        return back()->with('success', 'Heslo zmenené');
    }
}