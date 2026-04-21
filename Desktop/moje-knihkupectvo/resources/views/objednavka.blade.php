@extends('layouts.app')

@section('title', 'Objednávka - Rekapitulácia a údaje')

@section('content')
<main class="container">
    <h2 class="shoping-card-title">Dokončenie objednávky</h2>

    <div class="order-wrapper">
        
        <div class="order-step-box">
            <h3><i class="fas fa-shopping-basket"></i> Rekapitulácia košíka</h3>
            @foreach($items as $item)
            <div class="order-item-mini">
                <span>{{ $item['book']->title }} ({{ $item['quantity'] }}x)</span>
                <strong>{{ number_format($item['book']->final_price * $item['quantity'], 2) }}€</strong>
            </div>
            @endforeach
        </div>

        <form method="POST" action="{{ url('/objednavka') }}">
            @csrf
            
            <div class="order-step-box">
                <h3>1. Kontaktné a dodacie údaje</h3>
                <div class="account-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label>MENO</label>
                            <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label>PRIEZVISKO</label>
                            <input type="text" name="surname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>EMAIL</label>
                        <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label>ADRESA (Ulica a číslo)</label>
                        <input type="text" name="address" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>MESTO</label>
                            <input type="text" name="city" required>
                        </div>
                        <div class="form-group">
                            <label>PSČ</label>
                            <input type="text" name="postal_code" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-step-box">
                <h3>2. Spôsob dopravy</h3>
                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="radio" name="shipping_method" id="kurier" value="kurier" checked>
                        <label for="kurier">Kuriér na adresu <span>(+3,90€)</span></label>
                    </div>
                    <div class="checkbox-item">
                        <input type="radio" name="shipping_method" id="zasielkovna" value="zasielkovna">
                        <label for="zasielkovna">Packeta / Zásielkovňa <span>(+2,50€)</span></label>
                    </div>
                </div>
            </div>

            <div class="order-step-box">
                <h3 style="margin-bottom: 20px;">3. Spôsob platby</h3>
                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="radio" name="payment_method" id="karta" value="karta" checked>
                        <label for="karta">Platobná karta online</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="radio" name="payment_method" id="dobierka" value="dobierka">
                        <label for="dobierka">Dobierka pri prevzatí <span>(+1,20€)</span></label>
                    </div>
                </div>
            </div>

            <div class="order-final-bar">
                <div class="total-info-left">
                    <div class="total-row">
                        <span>CELKOVÁ SUMA: </span>
                        <span class="final-price">{{ number_format($total, 2) }}€</span>
                    </div>
                    <p class="vat-info">Vrátane DPH a dopravy</p>
                </div>
                
                <button type="submit" class="order-submit-btn">
                    ZÁVÄZNE OBJEDNAŤ S POVINNOSŤOU PLATBY
                </button>
            </div>

            <p class="terms-text">
                Odoslaním objednávky súhlasíte s obchodnými podmienkami.
            </p>
        </form>
    </div>
</main>
@endsection