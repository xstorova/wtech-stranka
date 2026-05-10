<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\CartItem;

class CartController extends Controller
{
    
    // Pomocná metóda – načíta košík z DB do session pre prihláseného používateľa
    private function syncDbToSession()
    {
        if (auth()->check()) {
            $items = CartItem::where('user_id', auth()->id())->with('book')->get();
            $cart = [];
            foreach ($items as $item) {
                $cart[$item->book_id] = $item->quantity;
            }
            session()->put('cart', $cart);
        }
    }

    // Pomocná metóda – uloží košík z session do DB pre prihláseného používateľa
    private function syncSessionToDb()
    {
        if (auth()->check()) {
            $cart = session()->get('cart', []);
            $userId = auth()->id();
            
            // Vymažeme staré záznamy a vložíme aktuálne
            CartItem::where('user_id', $userId)->delete();
            
            foreach ($cart as $bookId => $quantity) {
                if ($quantity > 0) {
                    CartItem::create([
                        'user_id' => $userId,
                        'book_id' => $bookId,
                        'quantity' => $quantity
                    ]);
                }
            }
        }
    }

    public function index() {
        $this->syncDbToSession(); // Pred zobrazením načítame z DB
        
        $cart = session()->get('cart', []);
        $total = 0;
        $items = [];
        
        foreach ($cart as $id => $quantity) {
            $book = Book::find($id);
            if ($book) {
                $items[] = [
                    'book' => $book,
                    'quantity' => $quantity
                ];
                $total += $book->final_price * $quantity;
            }
        }
        
        return view('kosik', compact('items', 'total'));
    }
    
    public function add(Request $request, $id) {
    $quantity = (int) $request->input('quantity', 1);
    if ($quantity < 1) $quantity = 1;
    
    $cart = session()->get('cart', []);
    
    if (isset($cart[$id])) {
        $cart[$id] += $quantity;
    } else {
        $cart[$id] = $quantity;
    }
    
    session()->put('cart', $cart);
    $this->syncSessionToDb();
    
    return back()->with('success', 'Kniha bola pridaná do košíka');
}
    
    public function remove($id) {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        
        $this->syncSessionToDb(); // Uložíme do DB
        
        return back();
    }
    
    public function clear() {
        session()->forget('cart');
        $this->syncSessionToDb(); 
        
        return back();
    }
    
    public function increase($id) {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]++;
        }
        
        session()->put('cart', $cart);
        $this->syncSessionToDb();
        
        return back();
    }

    public function decrease($id) {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]--;
            if ($cart[$id] <= 0) {
                unset($cart[$id]);
            }
        }
        
        session()->put('cart', $cart);
        $this->syncSessionToDb(); 
        
        return back();
    }

    // Táto metóda sa zavolá pri prihlásení – prenesie session košík do DB
    public static function mergeSessionCartOnLogin()
    {
        if (auth()->check()) {
            $sessionCart = session()->get('cart', []);
            $userId = auth()->id();
            
            foreach ($sessionCart as $bookId => $quantity) {
                $existing = CartItem::where('user_id', $userId)
                    ->where('book_id', $bookId)
                    ->first();
                
                if ($existing) {
                    $existing->update(['quantity' => $existing->quantity + $quantity]);
                } else {
                    CartItem::create([
                        'user_id' => $userId,
                        'book_id' => $bookId,
                        'quantity' => $quantity
                    ]);
                }
            }
        }
    }
}