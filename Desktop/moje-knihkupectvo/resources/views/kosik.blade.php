@extends('layouts.app')

@section('title', 'Košík')

@section('content')
<main class="card">
    <div class="shoping-card">Košík:</div>

    @forelse($items as $item)
    <div class="product-card">
        <div class="product-left">
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
        <div class="product-right">
            <div style="display: flex; align-items: center; gap: 20px;">
                <span>Počet: {{ $item['quantity'] }}</span>
                <div class="product-price">{{ number_format($item['book']->final_price * $item['quantity'], 2) }}€</div>
                <a href="{{ url('/kosik/remove/'.$item['book']->id) }}" class="remove-item">&times;</a>
            </div>
        </div>
    </div>
    @empty
    <p style="text-align: center; padding: 40px;">Košík je prázdny. <a href="{{ url('/') }}" style="color: #a69aff;">Prejsť na nákup</a></p>
    @endforelse

    @if(count($items) > 0)
    <div class="total-section">Total: {{ number_format($total, 2) }}€</div>

    <div class="checkout-container">
        <a href="{{ url('/objednavka') }}" class="checkout-button">Pokračovať k objednávke</a>
    </div>
    @endif
</main>
@endsection