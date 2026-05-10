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
        
        <!-- TMAVÝ ŠTVOREC - hlavné info o knihe -->
        <div class="book-detail-dark">
            <div class="book-layout" style="display: flex; flex-wrap: wrap; gap: 30px; align-items: flex-start; justify-content: center;">
                
                <!-- Book Cover + Galéria -->
                <div class="book-cover-section" style="display: flex; flex-direction: column; gap: 15px; align-items: center; flex: 1 1 300px; max-width: 100%;">
                    
                    {{-- HLAVNÝ OBRÁZOK – zmení sa po kliknutí na galériu --}}
                    <div class="book-cover-large" id="mainBookCover" style="cursor: pointer; transition: opacity 0.3s; width: 100%; display: flex; justify-content: center;">
                        @if($book->image)
                            <img src="{{ $book->image }}" alt="{{ $book->title }}" id="mainBookImage" style="max-height: 500px; max-width: 100%; width: auto; height: auto; object-fit: contain; border-radius: 8px;">
                        @else
                            <div style="height: 400px; width: 100%; max-width: 300px; background:#555; display:flex; align-items:center; justify-content:center; color:#999; border-radius: 8px;">
                                <i class="fas fa-book" style="font-size:60px;"></i>
                            </div>
                        @endif
                    </div>
                    
                    {{-- GALÉRIA FOTIEK – klikateľné náhľady --}}
                    @if($book->gallery && count($book->gallery) > 0)
                    <div class="book-gallery" style="width: 100%;">
                        <div style="display: flex; gap: 8px; flex-wrap: wrap; justify-content: center;">
                            {{-- Hlavný obrázok ako prvý náhľad --}}
                            @if($book->image)
                                <button type="button" onclick="swapMainImage('{{ $book->image }}')" 
                                        class="gallery-thumb active" 
                                        data-thumb="main"
                                        style="width: 50px; height: 70px; border-radius: 4px; overflow: hidden; border: 2px solid #c4b5fd; padding: 0; cursor: pointer; background: none; flex-shrink: 0;">
                                    <img src="{{ $book->image }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Hlavný">
                                </button>
                            @endif
                            
                            {{-- Galéria fotiek --}}
                            @foreach($book->gallery as $photo)
                                <button type="button" onclick="swapMainImage('{{ asset('storage/' . $photo) }}', this)" 
                                        class="gallery-thumb" 
                                        style="width: 50px; height: 70px; border-radius: 4px; overflow: hidden; border: 2px solid transparent; padding: 0; cursor: pointer; background: none; transition: border-color 0.2s; flex-shrink: 0;">
                                    <img src="{{ asset('storage/' . $photo) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Galéria">
                                </button>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Book Info -->
                <div class="book-info-panel" style="flex: 1 1 300px; max-width: 100%; min-width: 280px;">
                    <div class="book-main-info">
                        <h1 class="book-title-detail" style="font-size: clamp(1.5rem, 4vw, 2.5rem); word-break: break-word;">{{ $book->title }}</h1>
                        
                        @php
                            $detailAuthorSlug = $book->authorModel?->slug;
                            if (!$detailAuthorSlug && $book->author) {
                                $authorByName = \App\Models\Author::where('name', $book->author)->first();
                                $detailAuthorSlug = $authorByName?->slug;
                            }
                        @endphp
                        
                        @if($detailAuthorSlug)
                            <p class="book-author">
                                <a href="{{ url('/autor/'.$detailAuthorSlug) }}" style="color: #ccc; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#c4b5fd'" onmouseout="this.style.color='#ccc'">
                                    {{ $book->author }}
                                </a>
                            </p>
                        @else
                            <p class="book-author">{{ $book->author }}</p>
                        @endif
                        
                        <div style="display: flex; flex-wrap: wrap; gap: 5px; margin-top: 10px;">
                            @if($book->is_new)
                                <span class="tag-new">Novinka</span>
                            @endif
                            @if($book->is_preorder)
                                <span class="tag-preorder">Predpredaj</span>
                            @endif
                            @if($book->is_bestseller)
                                <span class="tag-bestseller">Bestseller</span>
                            @endif
                        </div>
                    </div>

                    <!-- Rating -->
                    <div class="rating-stars" style="margin: 15px 0;">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>

                    <!-- Book Meta -->
                    <div class="book-meta">
                        @if($book->series)
                        <div class="meta-item">
                            <span class="meta-label">
                                @if($book->series_number)
                                    {{ $book->series_number }}. diel série
                                @else
                                    Séria
                                @endif
                            </span>
                            <span class="meta-value">{{ $book->series }}</span>
                        </div>
                        @endif
                        @if($book->publisher)
                        <div class="meta-item">
                            <span class="meta-label">Vydavateľstvo</span>
                            <span class="meta-value">{{ $book->publisher }}</span>
                        </div>
                        @endif
                        @if($book->page_count)
                        <div class="meta-item">
                            <span class="meta-label">{{ $book->page_count }} strán</span>
                            <span class="meta-value">{{ $book->reading_time }}</span>
                        </div>
                        @endif
                        @if($book->language)
                        <div class="meta-item">
                            <span class="meta-label">Jazyk</span>
                            <span class="meta-value">{{ $book->language }}</span>
                        </div>
                        @endif
                        @if($book->binding)
                        <div class="meta-item">
                            <span class="meta-label">Väzba</span>
                            <span class="meta-value">{{ $book->binding }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Price & Buy Box -->
                    <div class="buy-box" style="display: flex; flex-direction: column; align-items: flex-start; gap: 0; margin-top: 20px;">
                        <div class="price-section" style="margin-bottom: 7px;">
                            <span class="current-price" style="font-size: clamp(1.5rem, 5vw, 2rem); font-weight: bold; color: #fff;">{{ number_format($book->final_price, 2) }} €</span>
                            @if($book->discount > 0)
                                <span class="old-price" style="font-size: 1.2rem; color: #999; text-decoration: line-through; margin-left: 10px;">{{ number_format($book->price, 2) }} €</span>
                            @endif
                        </div>

                        <div class="quantity" style="display: flex; align-items: center; background: #cfcfcf; border-radius: 4px; height: 32px; margin-bottom: 15px;">
                            <button type="button" onclick="updateQty(-1)" style="background: #878787; border: none; color: white; padding: 0 15px; font-size: 16px; height: 100%; cursor: pointer; display: flex; align-items: center; justify-content: center; border-radius: 4px 0 0 4px; line-height: 1;">-</button>
                            <input type="number" id="qty-input" value="1" min="1" style="width: 50px; height: 32px; text-align: center; font-size: 14px; font-weight: 500; color: #333; background: #cfcfcf; border: none; outline: none; margin: 0; padding: 0; -moz-appearance: textfield; appearance: textfield;">
                            <button type="button" onclick="updateQty(1)" style="background: #878787; border: none; color: white; padding: 0 15px; font-size: 16px; height: 100%; cursor: pointer; display: flex; align-items: center; justify-content: center; border-radius: 0 4px 4px 0; line-height: 1;">+</button>
                        </div>

                        @if($book->status === 'active')
                        <a id="add-to-cart-link" href="{{ url('/kosik/pridat/'.$book->id) }}" class="add-to-cart-btn" style="background: #c4b5fd; color: #333; padding: 15px 40px; border-radius: 10px; border: none; font-size: 1.1rem; cursor: pointer; display: flex; align-items: center; gap: 10px; width: 100%; justify-content: center; text-decoration: none; box-sizing: border-box;">
                            <i class="fas fa-shopping-cart"></i> Vložiť do košíka
                        </a>
                    @else
                        <div style="background: #666; color: #aaa; padding: 15px 40px; border-radius: 10px; font-size: 1.1rem; display: flex; align-items: center; gap: 10px; width: 100%; justify-content: center; cursor: not-allowed; box-sizing: border-box;">
                            <i class="fas fa-ban"></i> Nedostupné
                        </div>
                    @endif
                    </div>
                </div> 
            </div> 
        </div> 
    </main> 

    <script>
        function updateQty(change) {
            let input = document.getElementById('qty-input');
            let newVal = parseInt(input.value) + change;
            if (newVal >= 1) {
                input.value = newVal;
                updateCartLink();
            }
        }

        function updateCartLink() {
            let qty = document.getElementById('qty-input').value;
            let baseUrl = "{{ url('/kosik/pridat/'.$book->id) }}";
            document.getElementById('add-to-cart-link').href = baseUrl + "?quantity=" + qty;
        }

        // Inicializuj pri načítaní stránky
        updateCartLink();
    </script>

    <!-- Description -->
    <section class="book-description" style="margin-top: 30px; margin-bottom: 10px; padding: 20px 0;">
        <h3 style="margin-bottom: 15px;">Obsah:</h3>
        <p style="margin-bottom: 0; line-height: 1.7;">{{ $book->description }}</p>
    </section>
</main>

<!-- Editions Section (Purple Background) -->
<section class="editions-section" style="margin-top: 20px; padding-top: 40px; padding-bottom: 40px;">
    <div class="container">
        
        {{-- ===== KNihy z ROVNAKEJ SÉRIE ===== --}}
@if($seriesBooks->count() > 0)
    <h3 style="margin-bottom: 25px;">Knihy z série: <span style="color: #525252; ">{{ $book->series }}</span></h3>
    <div class="editions-grid">
        @foreach($seriesBooks as $seriesBook)
            <a href="{{ url('/knihy/'.$seriesBook->id) }}" class="edition-card {{ $seriesBook->status == 'soldout' ? 'sold-out' : '' }}" style="text-decoration: none; color: inherit;">
                <span class="edition-lang">{{ $seriesBook->language ?? 'Neznámy jazyk' }}</span>
                <span class="edition-type">{{ $seriesBook->binding ?? 'Neznáma väzba' }}</span>

                <div class="edition-cover">
                    @if($seriesBook->image)
                        <img src="{{ $seriesBook->image }}" alt="{{ $seriesBook->title }}">
                    @else
                        <span style="color: #999; font-size: 0.8rem;">Bez obrázka</span>
                    @endif
                </div>

                <div class="edition-meta">
                    <div style="font-weight: bold; font-size: 0.85rem; color: #333; margin-bottom: 4px; line-height: 1.2;">
                        {{ \Illuminate\Support\Str::limit($seriesBook->title, 25) }}
                    </div>
                    <div style="font-size: 0.75rem; color: #666;">{{ $seriesBook->author }}</div>
                </div>

                @if($seriesBook->status == 'soldout')
                    <div class="edition-price sold-out-tag">Vypredané</div>
                @else
                    <div class="edition-price add-to-cart-btn">
                        {{ number_format($seriesBook->final_price, 2) }} € <i class="fas fa-shopping-cart" style="font-size: 0.75rem;"></i>
                    </div>
                @endif

            </a>
        @endforeach
    </div>
@endif

        {{-- ===== SÚVISIACE KNihy (fallback) ===== --}}
        @if($relatedBooks->count() > 0)
            <h3 style="margin-bottom: 25px; margin-top: 30px;">Súvisiace knihy:</h3>
            <div class="editions-grid">
                @foreach($relatedBooks as $relatedBook)
                    <a href="{{ url('/knihy/'.$relatedBook->id) }}" class="edition-card {{ $relatedBook->status == 'soldout' ? 'sold-out' : '' }}" style="text-decoration: none; color: inherit;">
                        <span class="edition-lang">{{ $relatedBook->language ?? 'Neznámy jazyk' }}</span>
                        <span class="edition-type">{{ $relatedBook->binding ?? 'Neznáma väzba' }}</span>

                        <div class="edition-cover">
                            @if($relatedBook->image)
                                <img src="{{ $relatedBook->image }}" alt="{{ $relatedBook->title }}">
                            @else
                                <span style="color: #999; font-size: 0.8rem;">Bez obrázka</span>
                            @endif
                        </div>

                        <div style="text-align: center; margin-top: 8px;">
                            <div style="font-weight: bold; font-size: 0.9rem; color: #333; margin-bottom: 4px;">
                                {{ $relatedBook->title }}
                            </div>
                            <div style="font-size: 0.8rem; color: #666;">{{ $relatedBook->author }}</div>
                        </div>

                        @if($relatedBook->status == 'soldout')
                            <div class="edition-price sold-out-tag">Vypredané</div>
                        @else
                            <div class="edition-price add-to-cart-btn" style="text-decoration: none; margin-top: 10px;">
                                {{ number_format($relatedBook->final_price, 2) }} € <i class="fas fa-shopping-cart"></i>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif

        {{-- ===== Ak niet ničoho ===== --}}
        @if($seriesBooks->isEmpty() && $relatedBooks->isEmpty())
            <p style="color: #666; text-align: center; grid-column: 1 / -1;">Žiadne súvisiace knihy neboli nájdené.</p>
        @endif
        
        
    </div>
</section>

<!-- Recommendations - dynamický carousel náhodných kníh -->
@if(isset($carouselBooks) && $carouselBooks->count() > 0)
<section class="recommendations" style="margin-top: 40px; padding-top: 20px; padding-bottom: 40px;">
    <div class="container">
        <h3 style="margin-bottom: 25px;">Tiež by sa vám mohlo páčiť:</h3>
        <div class="rec-slider">
            <button class="rec-arrow left" type="button" aria-label="Doľava">
                <i class="fas fa-arrow-left"></i>
            </button>

            <div class="rec-books" id="recBooksDetail">
                @foreach($carouselBooks as $cBook)
                <a href="{{ url('/knihy/'.$cBook->id) }}" class="rec-book-placeholder"
                   style="background-image: url('{{ $cBook->image }}');
                          background-size: cover;
                          background-position: center;
                          display: block;
                          text-decoration: none;
                          position: relative;
                          flex-shrink: 0;
                          transition: transform 0.2s;">

                    @if($cBook->discount > 0)
                    <span style="position: absolute; top: 5px; right: 5px; background: #c4b5fd; color: #333; padding: 2px 6px; border-radius: 10px; font-size: 0.75rem; font-weight: bold;">
                        -{{ $cBook->discount }}%
                    </span>
                    @endif

                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.8); color: white; padding: 10px 5px; font-size: 0.8rem; text-align: center; border-radius: 0 0 4px 4px;">
                        <div style="font-weight: bold; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ \Illuminate\Support\Str::limit($cBook->title, 20) }}
                        </div>
                        <div style="font-size: 0.75rem; opacity: 0.9; margin-top: 2px;">
                            {{ number_format($cBook->final_price, 2) }} €
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <button class="rec-arrow right" type="button" aria-label="Doprava">
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
</section>

<script>
(function() {
    const box = document.getElementById('recBooksDetail');
    const left  = document.querySelector('.rec-arrow.left');
    const right = document.querySelector('.rec-arrow.right');
    if (!box || !left || !right) return;

    const getStep = () => {
        const card = box.querySelector('a');
        if (!card) return 150;
        const gap = parseInt(window.getComputedStyle(box).gap) || 15;
        return card.offsetWidth + gap;
    };

    left.addEventListener('click', () => {
        box.scrollBy({ left: -getStep(), behavior: 'smooth' });
    });
    right.addEventListener('click', () => {
        box.scrollBy({ left: getStep(), behavior: 'smooth' });
    });
})();
</script>
<script>
    // === VÝMENA HLAVNÉHO OBRÁZKA Z GALÉRIE ===
    function swapMainImage(imageSrc, thumbElement = null) {
        const mainImage = document.getElementById('mainBookImage');
        const mainCover = document.getElementById('mainBookCover');
        
        // Efekt fade-out
        mainCover.style.opacity = '0.5';
        
        setTimeout(() => {
            mainImage.src = imageSrc;
            mainCover.style.opacity = '1';
        }, 150);
        
        // Aktualizuj aktívny náhľad
        document.querySelectorAll('.gallery-thumb').forEach(thumb => {
            thumb.style.borderColor = 'transparent';
            thumb.classList.remove('active');
        });
        
        if (thumbElement) {
            thumbElement.style.borderColor = '#c4b5fd';
            thumbElement.classList.add('active');
        } else {
            // Ak klikli na hlavný (prvý) náhľad
            const mainThumb = document.querySelector('[data-thumb="main"]');
            if (mainThumb) {
                mainThumb.style.borderColor = '#c4b5fd';
                mainThumb.classList.add('active');
            }
        }
    }
    
    // Klik na hlavný obrázok otvorí lightbox (voliteľné)
    document.getElementById('mainBookCover')?.addEventListener('click', function() {
        const img = document.getElementById('mainBookImage').src;
        openLightbox(img);
    });
    
    // Jednoduchý lightbox
    function openLightbox(imageSrc) {
        // Odstráň existujúci lightbox
        const existing = document.getElementById('simpleLightbox');
        if (existing) existing.remove();
        
        const lightbox = document.createElement('div');
        lightbox.id = 'simpleLightbox';
        lightbox.style.cssText = `
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.9); z-index: 1000;
            display: flex; align-items: center; justify-content: center;
            cursor: zoom-out;
        `;
        lightbox.innerHTML = `
            <img src="${imageSrc}" style="max-width: 90%; max-height: 90%; object-fit: contain; border-radius: 8px;">
        `;
        lightbox.onclick = () => lightbox.remove();
        
        document.body.appendChild(lightbox);
    }
</script>
@endif

<!-- Reviews Section -->
<section class="reviews-section" style="margin-top: 40px; padding-top: 20px; padding-bottom: 40px;">
    <div class="container">
        <h3 style="margin-bottom: 25px;">Hodnotenie:</h3>

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

        <h3 class="reviews-title" style="margin-top: 30px; margin-bottom: 20px;">Recenzie:</h3>

        <div class="review-card" style="margin-bottom: 20px;">
            <div class="review-stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p class="review-text">Čítanie tejto série som dlho odkladala, lebo som na ňu na zahraničnom webe videla samé zlé recenzie... a napriek tomu, že nie som v knihách fanúšikom ropúch na ktorých sa dá jazdiť, či prílišného množstva kdejakých čudných bytostí, túto sériu som milovala od začiatku do konca! Určite odporúčam :-) je to zaujímavé a napínavé. Romantika je okrajová, čo je za mňa ok, a postavy som si zamilovala.</p>
        </div>

        <div class="review-card" style="margin-bottom: 20px;">
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