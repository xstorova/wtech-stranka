<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;

class AccountController extends Controller {
    
    public function show() {
        $carouselBooks = Book::where('status', 'active')->inRandomOrder()->limit(12)->get();
        return view('account', compact('carouselBooks'));
    }
    
    public function update(Request $request) {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id
        ]);
        
        $user->update($data);
        return back()->with('success', 'Údaje boli uložené');
    }

    public function updateAvatar(Request $request) {
        $request->validate([
            'avatar' => 'required|image|max:2048'
        ], [
            'avatar.image' => 'Súbor musí byť obrázok',
            'avatar.max'   => 'Obrázok môže mať max. 2MB',
        ]);

        $user = auth()->user();

        // Vymaž starý avatar ak existuje
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        return back()->with('success', 'Profilový obrázok bol zmenený');
    }

    public function removeAvatar() {
        $user = auth()->user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->update(['avatar' => null]);
        }

        return back()->with('success', 'Profilový obrázok bol odstránený');
    }
    
    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ], [
            'new_password.confirmed' => 'Heslá sa nezhodujú',
            'new_password.min' => 'Heslo musí mať aspoň 6 znakov',
            'current_password.required' => 'Zadajte pôvodné heslo',
        ]);
        
        $user = auth()->user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Pôvodné heslo je nesprávne']);
        }
        
        $user->password = $request->new_password;
        $user->save();
        
        return back()->with('success', 'Heslo bolo úspešne zmenené');
    }
}