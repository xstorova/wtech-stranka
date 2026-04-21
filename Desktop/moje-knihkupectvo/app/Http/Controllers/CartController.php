<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Book;

class CartController extends Controller {
    
    public function index() {
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
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        
        session()->put('cart', $cart);
        return back()->with('success', 'Kniha bola pridaná do košíka');
    }
    
    public function remove($id) {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return back();
    }
    
    public function clear() {
        session()->forget('cart');
        return back();
    }
    
    public function increase($id) {
    $cart = session()->get('cart', []);
    
    if (isset($cart[$id])) {
        $cart[$id]++;
    }
    
    session()->put('cart', $cart);
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
    return back();
}
}