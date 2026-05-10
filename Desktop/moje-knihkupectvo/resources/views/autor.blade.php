@extends('layouts.app')

@section('title', $author->name)

@section('content')
<main>

    <div class="author-profile-container">
        <div class="author-main-content">

            {{-- Fotka autora --}}
            <div class="author-book-style-photo">
                @if($author->photo)
                    <img src="{{ $author->photo }}" alt="{{ $author->name }}">
                @else
                    <div style="width:100%;height:100%;background:#555;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-user" style="font-size:60px;color:#999;"></i>
                    </div>
                @endif
            </div>

            {{-- Info o autorovi --}}
            <div class="author-text-details">
                <span class="author-label">AUTOR</span>
                <h1 class="author-full-name">{{ $author->name }}</h1>

                @if($author->bio)
                <div class="author-bio-short">
                    <p>{{ $author->bio }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Status bar --}}
        <div class="author-status-bar">
            <div class="status-item">
                <span class="status-label">STAV</span>
                <span class="status-value {{ $author->is_active ? 'active' : '' }}">
                    <i class="fas fa-circle"></i>
                    {{ $author->is_active ? 'Aktívny' : 'Neaktívny' }}
                </span>
            </div>

            <div class="status-item">
                <span class="status-label">POČET KNÍH</span>
                <span class="status-value">{{ $author->book_count }}</span>
            </div>

            @if($author->rating)
            <div class="status-item">
                <span class="status-label">HODNOTENIE</span>
                <span class="status-value" style="color:#c4b5fd;">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($author->rating))
                            <i class="fas fa-star"></i>
                        @elseif($i - 0.5 <= $author->rating)
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                    {{ $author->rating }}/5
                </span>
            </div>
            @endif

            @if($author->website)
            <div class="status-item status-item-right">
                <a href="{{ $author->website }}" target="_blank" class="author-web-link">
                    <i class="fas fa-globe"></i> Oficiálny web
                </a>
            </div>
            @endif
        </div>
    </div>

    {{-- Knihy autora --}}
    @if($books->count() > 0)
    <section class="best-sellers">
        <h2>Knihy autora</h2>

        @foreach($books->chunk(2) as $chunk)
        <div class="product-grid">
            @foreach($chunk as $book)
            <div class="product-card">
                <div class="book-cover-placeholder">
                    @if($book->image)
                        <img src="{{ $book->image }}" alt="{{ $book->title }}" style="width:100%;height:100%;object-fit:cover;">
                    @endif
                </div>
                <div class="product-info">
                    <h3><a class="name-of-the-book" href="{{ url('/knihy/'.$book->id) }}">{{ $book->title }}</a></h3>
                    <p>{{ Str::limit($book->description, 80) }}</p>
                    <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                        @if($book->status === 'active')
                            <a href="{{ url('/kosik/pridat/'.$book->id) }}" class="button-placeholder">
                                {{ number_format($book->final_price, 2) }} €
                            </a>
                        @else
                            <span class="button-placeholder" style="background:#999;cursor:not-allowed;">Nedostupné</span>
                        @endif
                        @if($book->discount > 0)
                            <span style="color:#ff6b6b;font-size:0.9rem;text-decoration:line-through;">
                                {{ number_format($book->price, 2) }} €
                            </span>
                            <span style="background:#c4b5fd;color:#333;padding:2px 8px;border-radius:12px;font-size:0.8rem;font-weight:bold;">
                                -{{ $book->discount }}%
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

            @if($chunk->count() < 2)
                <div class="product-card" style="visibility:hidden;"></div>
            @endif
        </div>
        @endforeach
    </section>
    @else
        <p style="text-align:center;padding:40px;color:#666;">Tento autor zatiaľ nemá žiadne knihy.</p>
    @endif

    {{-- Carousel odporúčaných kníh --}}
    @if(isset($carouselBooks) && $carouselBooks->count() > 0)
    <section class="recommendations">
        <div class="container">
            <h3>Tiež by sa vám mohlo páčiť:</h3>
            <div class="rec-slider">
                <button class="rec-arrow left" type="button"><i class="fas fa-arrow-left"></i></button>

                <div class="rec-books" id="recBooksAutor">
                    @foreach($carouselBooks as $cBook)
                    <a href="{{ url('/knihy/'.$cBook->id) }}" class="rec-book-placeholder"
                       style="background-image:url('{{ $cBook->image }}');background-size:cover;background-position:center;display:block;text-decoration:none;position:relative;flex-shrink:0;transition:transform 0.2s;">
                        @if($cBook->discount > 0)
                        <span style="position:absolute;top:5px;right:5px;background:#c4b5fd;color:#333;padding:2px 6px;border-radius:10px;font-size:0.75rem;font-weight:bold;">
                            -{{ $cBook->discount }}%
                        </span>
                        @endif
                        <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,0.8);color:white;padding:10px 5px;font-size:0.8rem;text-align:center;border-radius:0 0 4px 4px;">
                            <div style="font-weight:bold;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $cBook->title }}</div>
                            <div style="font-size:0.75rem;opacity:0.9;margin-top:2px;">{{ number_format($cBook->final_price, 2) }} €</div>
                        </div>
                    </a>
                    @endforeach
                </div>

                <button class="rec-arrow right" type="button"><i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
    </section>

    <script>
    (function() {
        const box = document.getElementById('recBooksAutor');
        const left  = box.closest('.rec-slider').querySelector('.rec-arrow.left');
        const right = box.closest('.rec-slider').querySelector('.rec-arrow.right');
        const getStep = () => {
            const card = box.querySelector('a');
            if (!card) return 150;
            return card.offsetWidth + (parseInt(window.getComputedStyle(box).gap) || 15);
        };
        left.addEventListener('click',  () => box.scrollBy({ left: -getStep(), behavior: 'smooth' }));
        right.addEventListener('click', () => box.scrollBy({ left:  getStep(), behavior: 'smooth' }));
    })();
    </script>
    @endif

</main>
@endsection