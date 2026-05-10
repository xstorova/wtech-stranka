@extends('layouts.app')

@section('title', 'Kníhkupectvo - Domov')

@section('content')

@if(auth()->check() && auth()->user()->email === 'admin@admin.com')
    <div style="background: #333; color: white; padding: 10px 10%; display: flex; justify-content: space-between; align-items: center; border-radius: 4px; margin-bottom: 20px;">
        <span><i class="fas fa-user-shield"></i> Režim: <strong>Používateľský náhľad</strong></span>
        <a href="{{ route('admin.knihy.index') }}" style="color: #c4b5fd; text-decoration: none; font-weight: bold;">SPÄŤ DO ADMIN ROZHRANIA</a>
    </div>
@endif

<section class="news-section">
    <h2>Novinky</h2>
    
    <div style="position: relative; overflow: hidden; border-radius: 4px;">
        <div id="slider" style="display: flex; transition: transform 0.4s ease; width: 100%;">
            <div class="slide" style="min-width: 100%; height: 350px; background: #eee; display: flex; align-items: center; justify-content: center; color: #aaa; font-size: 1.2rem;">
                
            </div>
            <div class="slide" style="min-width: 100%; height: 350px; background: #e6e6ff; display: flex; align-items: center; justify-content: center; color: #aaa; font-size: 1.2rem;">
                
            </div>
            <div class="slide" style="min-width: 100%; height: 350px; background: #f0eeff; display: flex; align-items: center; justify-content: center; color: #aaa; font-size: 1.2rem;">
                
            </div>
            <div class="slide" style="min-width: 100%; height: 350px; background: #eefffc; display: flex; align-items: center; justify-content: center; color: #aaa; font-size: 1.2rem;">
                
            </div>
        </div>

        <!-- šípky -->
        <button onclick="changeSlide(-1)" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 1rem; box-shadow: 0 2px 5px rgba(0,0,0,0.15);">←</button>
        <button onclick="changeSlide(1)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 1rem; box-shadow: 0 2px 5px rgba(0,0,0,0.15);">→</button>
    </div>

    <!-- bodky -->
    <div class="dots" id="dots" style="text-align: center; margin-top: 15px;">
        <span onclick="goToSlide(0)" style="display:inline-block; width:8px; height:8px; background:#a47dff; border-radius:50%; margin:0 5px; cursor:pointer;"></span>
        <span onclick="goToSlide(1)" style="display:inline-block; width:8px; height:8px; background:#ccc; border-radius:50%; margin:0 5px; cursor:pointer;"></span>
        <span onclick="goToSlide(2)" style="display:inline-block; width:8px; height:8px; background:#ccc; border-radius:50%; margin:0 5px; cursor:pointer;"></span>
        <span onclick="goToSlide(3)" style="display:inline-block; width:8px; height:8px; background:#ccc; border-radius:50%; margin:0 5px; cursor:pointer;"></span>
    </div>
</section>

<script>
    let current = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('#dots span');

    function updateSlider() {
        document.getElementById('slider').style.transform = `translateX(-${current * 100}%)`;
        dots.forEach((d, i) => d.style.background = i === current ? '#a47dff' : '#ccc');
    }

    function changeSlide(dir) {
        current = (current + dir + slides.length) % slides.length;
        updateSlider();
    }

    function goToSlide(index) {
        current = index;
        updateSlider();
    }
    setInterval(() => changeSlide(1), 4000);
</script>

<section class="filters-section" id="filters">
    <div class="filters-container">
        <form method="GET" action="{{ url('/') }}#filters" id="filter-form" style="display: contents;">
            @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
            @if(request('zlava')) <input type="hidden" name="zlava" value="{{ request('zlava') }}"> @endif
            @if(request('cena_od')) <input type="hidden" name="cena_od" value="{{ request('cena_od') }}"> @endif
            @if(request('cena_do')) <input type="hidden" name="cena_do" value="{{ request('cena_do') }}"> @endif

            <div class="sort-box">
                <label for="sort-select"><i class="fas fa-sort"></i> Zoradiť podľa:</label>
                <select id="sort-select" name="zoradit" class="sort-select" onchange="document.getElementById('filter-form').submit()">
                    <option value="" {{ !request('zoradit') ? 'selected' : '' }}>Vyberte...</option>
                    <option value="cena-vzostupne" {{ request('zoradit') == 'cena-vzostupne' ? 'selected' : '' }}>Cena: od najnižšej</option>
                    <option value="cena-zostupne" {{ request('zoradit') == 'cena-zostupne' ? 'selected' : '' }}>Cena: od najvyššej</option>
                    <option value="nazov-az" {{ request('zoradit') == 'nazov-az' ? 'selected' : '' }}>Názov: A-Z</option>
                    <option value="nazov-za" {{ request('zoradit') == 'nazov-za' ? 'selected' : '' }}>Názov: Z-A</option>
                </select>
            </div>
        </form>

        <div class="sort-box" style="gap: 5px;">
            <label><i class="fas fa-euro-sign"></i> Cena:</label>
            <form method="GET" action="{{ url('/') }}#filters" style="display: flex; gap: 5px; align-items: center;">
                @foreach(request()->except(['cena_od','cena_do','page']) as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $v)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
                <input type="number" name="cena_od" placeholder="od" value="{{ request('cena_od') }}"
                       style="width: 60px; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                <span style="color: #777;">-</span>
                <input type="number" name="cena_do" placeholder="do" value="{{ request('cena_do') }}"
                       style="width: 60px; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                <button type="submit" style="background: #c4b5fd; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer;">
                    <i class="fas fa-filter"></i>
                </button>
            </form>
        </div>

        <!-- ŽÁNRE – checkboxy pre viacnásobný výber -->
        <div class="quick-filters">
            <span class="filter-label">Žánre:</span>
            
            <!-- Zľavy ako samostatný filter -->
            @if(request('zlava') == 'ano')
                <a href="{{ url('/') }}?{{ http_build_query(request()->except('zlava')) }}#filters" class="filter-chip active">Zľavy ✕</a>
            @else
                <a href="{{ url('/') }}?{{ http_build_query(request()->all() + ['zlava' => 'ano']) }}#filters" class="filter-chip">Zľavy</a>
            @endif

            <!-- Formulár pre žánre -->
            <form method="GET" action="{{ url('/') }}#filters" id="genre-form" style="display: contents;">
                <!-- Zachovaj ostatné parametre -->
                @foreach(request()->except(['zaner','page']) as $key => $value)
                    @if($key != 'zaner' && !is_array($value))
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach

                @foreach($genres as $genre)
                    @php
                        $selectedGenres = request('zaner', []);
                        if (!is_array($selectedGenres)) {
                            $selectedGenres = [$selectedGenres];
                        }
                        $isSelected = in_array($genre->slug, $selectedGenres);
                    @endphp
                    
                    <label class="filter-chip {{ $isSelected ? 'active' : '' }}" style="cursor: pointer; user-select: none;">
                        <input type="checkbox" name="zaner[]" value="{{ $genre->slug }}" 
                               {{ $isSelected ? 'checked' : '' }}
                               onchange="document.getElementById('genre-form').submit()"
                               style="display: none;">
                        {{ $genre->name }}
                        @if($isSelected) ✕ @endif
                    </label>
                @endforeach
            </form>
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

                    @if($book->authorModel)
                        <a href="{{ url('/autor/'.$book->authorModel->slug) }}" class="writer">{{ $book->author }}</a>
                    @else
                        <span class="writer" style="cursor: default;">{{ $book->author }}</span>
                    @endif

                    <p>{{ Str::limit($book->description, 50) }}</p>
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        @if($book->status === 'active')
                            <a href="{{ url('/kosik/pridat/'.$book->id) }}" class="button-placeholder">
                                {{ number_format($book->final_price, 2) }} €
                            </a>
                        @else
                            <span class="button-placeholder" style="background: #999; cursor: not-allowed;">
                                Nedostupné
                            </span>
                        @endif
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

@if(isset($carouselBooks) && $carouselBooks->count() > 0)
<section class="recommendations">
    <div class="container">
        <h3>Tiež by sa vám mohlo páčiť:</h3>
        <div class="rec-slider">
            <button class="rec-arrow left" type="button" aria-label="Doľava">
                <i class="fas fa-arrow-left"></i>
            </button>

            <div class="rec-books" id="recBooks">
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
                            {{ $cBook->title }}
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
    const box = document.getElementById('recBooks');
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
@endif
@endsection