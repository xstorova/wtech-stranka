@extends('layouts.app')

@section('title', 'Košík')

@section('content')
<main class="card">
    <div class="shoping-card">Košík:</div>

    @forelse($items as $item)
    <div class="cart-product-card">

        {{-- VĽAVO: Kniha --}}
        <div class="cart-product-left">
            <div class="book-cover">
                @if($item['book']->image)
                    <img src="{{ $item['book']->image }}" alt="{{ $item['book']->title }}">
                @endif
            </div>
            <div class="book-info">
                <a class="book-title" href="{{ url('/knihy/'.$item['book']->id) }}">{{ $item['book']->title }}</a>
                <a class="book-author" href="#">{{ $item['book']->author }}</a>
            </div>
        </div>

        {{-- VPRAVO: Cena + Množstevník + krížik --}}
        <div class="cart-product-right">
            <div class="cart-product-price">{{ number_format($item['book']->final_price * $item['quantity'], 2) }}€</div>
            
            <div class="cart-quantity">
                <a href="{{ url('/kosik/znizit/'.$item['book']->id) }}" class="qty-btn">-</a>
                <span class="qty-value">{{ $item['quantity'] }}</span>
                <a href="{{ url('/kosik/zvysit/'.$item['book']->id) }}" class="qty-btn">+</a>
            </div>
            
            <a href="{{ url('/kosik/remove/'.$item['book']->id) }}" class="remove-item">&times;</a>
        </div>

    </div>
    @empty
    <div class="cart-empty">
        <p>Košík je prázdny. <a href="{{ url('/') }}">Prejsť na nákup</a></p>
    </div>
    @endforelse

    @if(count($items) > 0)
    <div class="total-section">Celková suma: {{ number_format($total, 2) }}€</div>

    <div class="checkout-container">
        <a href="{{ url('/objednavka') }}" class="checkout-button">Pokračovať k objednávke</a>
    </div>
    @endif
</main>
@endsection