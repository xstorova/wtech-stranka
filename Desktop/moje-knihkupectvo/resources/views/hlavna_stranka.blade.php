@extends('layouts.app')

@section('title', 'Kníhkupectvo - Domov')

@section('content')

@if(auth()->check() && auth()->user()->email === 'admin@admin.com')
    <div style="background: #333; color: white; padding: 10px 10%; display: flex; justify-content: space-between; align-items: center; border-radius: 4px; margin-bottom: 20px;">
        <span><i class="fas fa-user-shield"></i> Režim: <strong>Používateľský náhľad</strong></span>
        <a href="{{ url('/admin') }}" style="color: #c4b5fd; text-decoration: none; font-weight: bold;">SPÄŤ DO ADMIN ROZHRANIA</a>
    </div>
@endif

<section class="news-section">
    <h2>Novinky</h2>
    <div class="slider-container">
        <div class="side-slide"></div>
        <div class="main-slide">
            <button class="arrow left">←</button>
            <button class="arrow right">→</button>
        </div>
        <div class="side-slide"></div>
    </div>
    <div class="dots">
        <span></span><span></span><span class="active"></span><span></span><span></span>
    </div>
</section>

<section class="filters-section">
    <div class="filters-container">
        <form method="GET" action="{{ url('/') }}" style="display: contents;">
            @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
            @if(request('kategoria')) <input type="hidden" name="kategoria" value="{{ request('kategoria') }}"> @endif
            @if(request('zlava')) <input type="hidden" name="zlava" value="{{ request('zlava') }}"> @endif
            
            <div class="sort-box">
                <label for="sort-select"><i class="fas fa-sort"></i> Zoradiť podľa:</label>
                <select id="sort-select" name="zoradit" class="sort-select" onchange="this.form.submit()">
                    <option value="" {{ !request('zoradit') ? 'selected' : '' }}>Vyberte...</option>
                    <option value="cena-vzostupne" {{ request('zoradit') == 'cena-vzostupne' ? 'selected' : '' }}>Cena: od najnižšej</option>
                    <option value="cena-zostupne" {{ request('zoradit') == 'cena-zostupne' ? 'selected' : '' }}>Cena: od najvyššej</option>
                    <option value="nazov-az" {{ request('zoradit') == 'nazov-az' ? 'selected' : '' }}>Názov: A-Z</option>
                    <option value="nazov-za" {{ request('zoradit') == 'nazov-za' ? 'selected' : '' }}>Názov: Z-A</option>
                </select>
            </div>
        </form>

        <div class="quick-filters">
            <span class="filter-label">Rýchle filtre:</span>
            @if(request('zlava') == 'ano')
                <a href="{{ url('/') }}?{{ http_build_query(request()->except('zlava')) }}" class="filter-chip active">Zľavy ✕</a>
            @else
                <a href="{{ url('/') }}?{{ http_build_query(request()->all() + ['zlava' => 'ano']) }}" class="filter-chip">Zľavy</a>
            @endif
            
            @foreach($categories as $cat)
                @if(request('kategoria') == $cat)
                    <a href="{{ url('/') }}?{{ http_build_query(request()->except('kategoria')) }}" class="filter-chip active">{{ $cat }} ✕</a>
                @else
                    <a href="{{ url('/') }}?{{ http_build_query(request()->all() + ['kategoria' => $cat]) }}" class="filter-chip">{{ $cat }}</a>
                @endif
            @endforeach
        </div>

        <div class="results-count">
            Zobrazených <strong>{{ $books->count() }}</strong> z <strong>{{ $books->total() }}</strong> produktov
        </div>
    </div>
</section>

<section class="best-sellers">
    <h2>
        @if(request('kategoria')) {{ request('kategoria') }}
        @elseif(request('zlava')) Knihy so zľavou
        @else Najpredávanejšie @endif
    </h2>
    
    @if($books->count() > 0)
        @foreach($books->chunk(2) as $chunk)
        <div class="product-grid">
            @foreach($chunk as $book)
            <div class="product-card">
                <div class="book-cover-placeholder">
                    @if($book->image)
                        <img src="{{ $book->image }}" alt="{{ $book->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @endif
                </div>
                <div class="product-info">
                    <h3><a class="name-of-the-book" href="{{ url('/knihy/'.$book->id) }}">{{ $book->title }}</a></h3>
                    <a href="#" class="writer">{{ $book->author }}</a>
                    <p>{{ Str::limit($book->description, 50) }}</p>
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <a href="{{ url('/kosik/pridat/'.$book->id) }}" class="button-placeholder">
                            {{ number_format($book->final_price, 2) }} €
                        </a>
                        @if($book->discount > 0)
                            <span style="color: #ff6b6b; font-size: 0.9rem; text-decoration: line-through;">
                                {{ number_format($book->price, 2) }} €
                            </span>
                            <span style="background: #c4b5fd; color: #333; padding: 2px 8px; border-radius: 12px; font-size: 0.8rem; font-weight: bold;">
                                -{{ $book->discount }}%
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            
            @if($chunk->count() < 2)
            <div class="product-card" style="visibility: hidden;"></div>
            @endif
        </div>
        @endforeach
    @else
        <div style="text-align: center; padding: 60px;">
            <p>Žiadne knihy neboli nájdené.</p>
        </div>
    @endif
</section>

    <nav class="pagination-container">
        {{ $books->appends(request()->query())->links('partials.pagination') }}
    </nav>

@if($books->count() > 0)
<section class="recommendations">
    <div class="container">
        <h3>Tiež by sa vám mohlo páčiť:</h3>
        <div class="rec-slider">
            <button class="rec-arrow left"><i class="fas fa-arrow-left"></i></button>
            <div class="rec-books">
                @foreach($books->take(5) as $book)
                <a href="{{ url('/knihy/'.$book->id) }}" class="rec-book-placeholder" style="background-image: url('{{ $book->image }}'); background-size: cover; display: block;"></a>
                @endforeach
            </div>
            <button class="rec-arrow right"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</section>
@endif
@endsection