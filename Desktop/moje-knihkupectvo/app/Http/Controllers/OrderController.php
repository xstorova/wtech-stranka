<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;

class OrderController extends Controller {
    
    public function show() {
        $cart = session()->get('cart', []);
        $items = [];
        $subtotal = 0;
        
        foreach ($cart as $id => $quantity) {
            $book = Book::find($id);
            if ($book) {
                $items[] = ['book' => $book, 'quantity' => $quantity];
                $subtotal += $book->final_price * $quantity;
            }
        }
        
        $shipping = 3.90;
        $total = $subtotal + $shipping;
        
        return view('objednavka', compact('items', 'subtotal', 'shipping', 'total'));
    }
    
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'shipping_method' => 'required',
            'payment_method' => 'required'
        ]);
        
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Košík je prázdny');
        }
        
        $total = 0;
        foreach ($cart as $id => $qty) {
            $book = Book::find($id);
            if ($book) $total += $book->final_price * $qty;
        }
        
        $data['total'] = $total + 3.90; // + doprava
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';
        
        $order = Order::create($data);
        
        foreach ($cart as $id => $quantity) {
            $book = Book::find($id);
            if ($book) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $id,
                    'quantity' => $quantity,
                    'price' => $book->final_price
                ]);
            }
        }
        
        session()->forget('cart');
        return redirect('/')->with('success', 'Objednávka vytvorená!');
    }
}