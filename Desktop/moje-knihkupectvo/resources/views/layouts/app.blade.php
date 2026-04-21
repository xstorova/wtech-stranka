<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kníhkupectvo')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header>
        <div class="top-bar">
            <div class="logo-placeholder"></div>
            
            <div class="header-icons">
                @auth
                    <a href="{{ url('/account') }}" class="icon-circle" title="Môj účet">
                        <i class="fas fa-user"></i>
                    </a>
                @else
                    <a href="{{ url('/login') }}" class="icon-circle" title="Prihlásenie"></a>
                @endauth
                
                <a class="icon-book" href="{{ url('/') }}">
                    <i class="fas fa-book-open"></i>
                </a>

                <div class="cart-wrapper">
                    <a class="icon-cart" href="{{ url('/kosik') }}">
                        <i class="fas fa-shopping-cart"></i>
                        @php
                            $cart = session()->get('cart', []);
                            $cartCount = count($cart);
                        @endphp
                        @if($cartCount > 0)
                            <span style="position: absolute; top: -5px; right: -5px; background: red; color: white; border-radius: 50%; width: 20px; height: 20px; font-size: 12px; display: flex; align-items: center; justify-content: center;">{{ $cartCount }}</span> 
                        @endif
                    </a>

                    <!-- Mini košík s všetkými detailmi -->
                    <div class="cart-menu">
                        <div class="triangle"></div>
                        
                        <div class="cart-items">
                        @php
                            $cart = session()->get('cart', []);
                            $cartTotal = 0;
                        @endphp
                        @forelse($cart as $id => $quantity)
                            @php $book = \App\Models\Book::find($id); @endphp
                            @if($book)
                                @php $cartTotal += $book->final_price * $quantity; @endphp
                                <div class="book-in-cart">
                                    <div class="book-img" style="background-image: url('{{ $book->image }}'); background-size: cover;"></div>
                                    
                                    <div class="book-info">
                                        <span class="title">{{ $book->title }}</span>
                                        <span class="author">{{ $book->author }}</span>
                                        <span class="status">{{ $quantity }} ks</span>
                                    </div>
                                    
                                    <div class="book-controls">
                                        <a href="{{ url('/kosik/remove/'.$id) }}" class="remove" title="Odstrániť">&times;</a>
                                        
                                        <!-- TLAČIDLÁ + A - -->
                                        <div class="quantity" style="display: flex; align-items: center; background: #cfcfcf; border-radius: 4px; overflow: hidden; margin-top: 5px;">
                                            <a href="{{ url('/kosik/znizit/'.$id) }}" style="background: #878787; border: none; color: white; padding: 2px 8px; text-decoration: none; font-size: 14px; display: flex; align-items: center; justify-content: center; min-width: 25px;">-</a>
                                            <span style="padding: 0 10px; font-size: 13px; min-width: 20px; text-align: center; color: #333;">{{ $quantity }}</span>
                                            <a href="{{ url('/kosik/zvysit/'.$id) }}" style="background: #878787; border: none; color: white; padding: 2px 8px; text-decoration: none; font-size: 14px; display: flex; align-items: center; justify-content: center; min-width: 25px;">+</a>
                                        </div>
                                        
                                        <span style="color: white; font-size: 12px; margin-top: 5px;">{{ number_format($book->final_price * $quantity, 2) }}€</span>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="book-in-cart">
                                <div class="book-info" style="text-align: center; width: 100%;">
                                    <span class="author">Košík je prázdny</span>
                                </div>
                            </div>
                        @endforelse
                    </div>
                        
                        @if(count($cart) > 0)
                            <div class="shipping-section">
                                <i class="fas fa-truck"></i>
                                <div class="progress-bar">
                                    <div class="fill" style="width: {{ min(($cartTotal/50)*100, 100) }}%"></div>
                                </div>
                                <span class="total-price">{{ number_format($cartTotal, 2) }}€</span>
                            </div>

                            <a href="{{ url('/objednavka') }}" class="btn-checkout" style="display: block; text-align: center; text-decoration: none; line-height: 30px;">Dokončiť</a>
                        @endif
                    </div> 
                </div> 
            </div> 
        </div>

        <div class="search-container">
            <div class="search-bar">
                <span class="search-icon"><i class="fas fa-search"></i></span>
                
                <form action="{{ url('/') }}" method="GET">
                    <input type="text" placeholder="Hľadať..." aria-label="Hľadať na stránke" name="q" value="{{ request('q') }}">
                    <button type="submit" style="display: none;"></button>
                </form>
                
                               <!-- KOMPLETNÝ MEGA MENU -->
                    <div class="burger-wrapper">
                        <i class="fas fa-bars"></i>
                        <div class="mega-menu">
                            <div class="triangle"></div>
                            <div class="menu-grid">
                                @foreach($all_genres->chunk(ceil($all_genres->count() / 4)) as $chunk)
                                    <div class="menu-column">
                                        <ul>
                                            @foreach($chunk as $genre)
                                                <li>
                                                    <a href="{{ url('/?kategoria='.$genre->name) }}">
                                                        {{ $genre->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @if(session('success'))
        <div style="background: #b9ff6f; color: white; padding: 15px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #fa8b8b; color: white; padding: 15px; text-align: center;">
            {{ session('error') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer></footer>

</body>
</html>