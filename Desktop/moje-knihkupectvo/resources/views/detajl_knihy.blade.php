@extends('layouts.app')

@section('title', $book->title)

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
    </div>
</div>

<main class="detail-page">
    <div class="container">
        
        <!-- Book Header Section -->
        <section class="book-header">
            <div class="book-main-info">
                <h1 class="book-title-detail">{{ $book->title }}</h1>
                <p class="book-author">{{ $book->author }}</p>
                @if($book->is_new)
                    <span class="tag-new">Novinka</span>
                @endif
                @if($book->is_preorder)
                    <span class="tag-preorder">Predpredaj</span>
                @endif
            </div>
        </section>

        <!-- Book Detail Section -->
        <section class="book-detail-section">
            <div class="book-layout">
                <!-- Book Cover -->
                <div class="book-cover-large">
                    @if($book->image)
                        <img src="{{ $book->image }}" alt="{{ $book->title }}">
                    @endif
                </div>

                <!-- Book Info -->
                <div class="book-info-panel">
                    <!-- Rating -->
                    <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>

                    <!-- Book Meta -->
                    <div class="book-meta">
                        <div class="meta-item">
                            <span class="meta-label">1. diel série</span>
                            <span class="meta-value">Férska sága</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">vydavateľstvo</span>
                            <span class="meta-value">Slovart, 2022</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">400 strán</span>
                            <span class="meta-value">7-8 hodín čítania</span>
                        </div>
                    </div>

                    <!-- Price & Buy Box -->
                    <div class="buy-box">
                        <div class="price-section">
                            <span class="current-price">{{ number_format($book->final_price, 2) }} €</span>
                            @if($book->discount > 0)
                                <span class="old-price">{{ number_format($book->price, 2) }} €</span>
                            @endif
                        </div>
                        <a href="{{ url('/kosik/pridat/'.$book->id) }}" class="add-to-cart-btn" style="text-decoration: none; text-align: center;">
                            <i class="fas fa-shopping-cart"></i> Vložiť do košíka
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Description -->
        <section class="book-description">
            <h3>Obsah:</h3>
            <p>{{ $book->description }}</p>
        </section>

    </div>
</main>

<!-- Editions Section (Purple Background) -->
<section class="editions-section">
    <div class="container">
        <h3>Iné vydania:</h3>
        <div class="editions-grid">
            <div class="edition-card">
                <span class="edition-lang">Slovenčina</span>
                <span class="edition-type">pevná väzba</span>
                <div class="edition-cover">
                    <img src="" alt="Krutý princ">
                </div>
                <button class="edition-price add-to-cart-btn">
                    22,00 € <i class="fas fa-shopping-cart"></i>
                </button>
            </div>

            <div class="edition-card">
                <span class="edition-lang">Angličtina</span>
                <span class="edition-type">mäkká väzba</span>
                <div class="edition-cover">
                    @if($book->image)
                        <img src="{{ $book->image }}" alt="{{ $book->title }}">
                    @endif
                </div>
                <button class="edition-price add-to-cart-btn">
                    12,90 € <i class="fas fa-shopping-cart"></i>
                </button>
            </div>

            <div class="edition-card">
                <span class="edition-lang">Slovenčina</span>
                <span class="edition-type">brožovaná väzba</span>
                <div class="edition-cover">
                    <img src="https://mrtns.sk/tovar/_l/306/l306328.jpg?v=17730787822" alt="Krutý princ">
                </div>
                <button class="edition-price add-to-cart-btn">
                    12,90 € <i class="fas fa-shopping-cart"></i>
                </button>
            </div>

            <div class="edition-card sold-out">
                <span class="edition-lang">Čeština</span>
                <span class="edition-type">pevná väzba</span>
                <div class="edition-cover">
                    <img src="https://mrtns.sk/tovar/_l/2602/l2602429.jpg?v=17732068272" alt="Krutý princ">
                </div>
                <div class="edition-price sold-out-tag">
                    Vypredané
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recommendations -->
<section class="recommendations">
    <div class="container">
        <h3>Tiež by sa vám mohlo páčiť:</h3>
        <div class="rec-slider">
            <button class="rec-arrow left"><i class="fas fa-arrow-left"></i></button>
            <div class="rec-books">
                <div class="rec-book-placeholder"></div>
                <div class="rec-book-placeholder"></div>
                <div class="rec-book-placeholder"></div>
                <div class="rec-book-placeholder"></div>
                <div class="rec-book-placeholder"></div>
            </div>
            <button class="rec-arrow right"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="reviews-section">
    <div class="container">
        <h3>Hodnotenie:</h3>
        
        <div class="rating-summary">
            <div class="rating-big">
                <span class="rating-number">4,3</span>
                <span class="rating-total">/ 5</span>
            </div>
            
            <div class="rating-breakdown">
                <div class="rating-row">
                    <span class="count">297</span>
                    <div class="stars">
                        <i class="fas fa-star"></i> 
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="rating-row">
                    <span class="count">122</span>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
                <div class="rating-row">
                    <span class="count">54</span>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
                <div class="rating-row">
                    <span class="count">10</span>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
                <div class="rating-row">
                    <span class="count">17</span>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="reviews-title">Recenzie:</h3>
        
        <div class="review-card">
            <div class="review-stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p class="review-text">Čítanie tejto série som dlho odkladala, lebo som na ňu na zahraničnom webe videla samé zlé recenzie... a napriek tomu, že nie som v knihách fanúšikom ropúch na ktorých sa dá jazdiť, či prílišného množstva kdejakých čudných bytostí, túto sériu som milovala od začiatku do konca! Určite odporúčam :-) je to zaujímavé a napínavé. Romantika je okrajová, čo je za mňa ok, a postavy som si zamilovala.</p>
        </div>

        <div class="review-card">
            <div class="review-stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p class="review-text">Táto úžasná kniha si ma získala už prvými stranami. Je to jedna z najlepších kníh čo som čítala. Veľmi ju odporúčam.</p>
        </div>
    </div>
</section>
@endsection