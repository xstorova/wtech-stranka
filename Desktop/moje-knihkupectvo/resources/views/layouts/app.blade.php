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
            <!--- LOGO --->
            <a href="{{ url('/') }}" style="text-decoration: none;">
            <svg width="250" viewBox="0 0 680 220" role="img" style="display:block; margin-bottom:0;">
            <title>Feyre logo</title>
            <g transform="translate(180, 110)">
                <path d="M-60,-45 Q-30,-50 0,-40 L0,50 Q-30,45 -60,40 Z" fill="#c4b5fd" opacity="0.85"/>
                <path d="M0,-40 Q30,-50 60,-45 L60,40 Q30,45 0,50 Z" fill="#a69aff" opacity="0.85"/>
                <rect x="-4" y="-42" width="8" height="94" rx="2" fill="#7c6fcd"/>
                <line x1="-50" y1="-15" x2="-10" y2="-18" stroke="white" stroke-width="1.5" opacity="0.5"/>
                <line x1="-50" y1="-5" x2="-10" y2="-8" stroke="white" stroke-width="1.5" opacity="0.5"/>
                <line x1="-50" y1="5" x2="-10" y2="3" stroke="white" stroke-width="1.5" opacity="0.5"/>
                <line x1="-50" y1="15" x2="-10" y2="13" stroke="white" stroke-width="1.5" opacity="0.5"/>
                <line x1="-50" y1="25" x2="-30" y2="24" stroke="white" stroke-width="1.5" opacity="0.5"/>
                <line x1="10" y1="-18" x2="50" y2="-15" stroke="white" stroke-width="1.5" opacity="0.5"/>
                <line x1="10" y1="-8" x2="50" y2="-5" stroke="white" stroke-width="1.5" opacity="0.5"/>
                <line x1="10" y1="3" x2="50" y2="5" stroke="white" stroke-width="1.5" opacity="0.5"/>
                <line x1="10" y1="13" x2="50" y2="15" stroke="white" stroke-width="1.5" opacity="0.5"/>
                <line x1="10" y1="24" x2="35" y2="25" stroke="white" stroke-width="1.5" opacity="0.5"/>
            </g>
            <text x="265" y="125"
                    font-family="Georgia, serif"
                    font-size="72"
                    font-weight="300"
                    letter-spacing="12"
                    fill="#3d3560">FEYRE</text>
            <text x="268" y="152"
                    font-family="Georgia, serif"
                    font-size="20"
                    font-weight="400"
                    letter-spacing="6"
                    fill="#a69aff">kníhkupectvo</text>
            <line x1="265" y1="160" x2="530" y2="160" stroke="#c4b5fd" stroke-width="1" opacity="0.6"/>
            </svg>
            </a>
            
            <div class="header-icons">
                @auth
                    <a href="{{ url('/account') }}" class="icon-circle" title="Môj účet" style="overflow: hidden; position: relative;">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/'.auth()->user()->avatar) }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; position: absolute; top: 0; left: 0;">
                        @else
                            <i class="fas fa-user" style="font-size: 16px; color: #666;"></i>
                        @endif
                    </a>
                @else
                    <a href="{{ url('/login') }}" class="icon-circle" title="Prihlásenie">
                        <i class="fas fa-user" style="font-size: 16px; color: #666;"></i>
                    </a>
                @endauth
                
                <a class="icon-book" href="{{ url('/') }}">
                    <i class="fas fa-book-open"></i>
                </a>

                <div class="cart-wrapper">
                    <a class="icon-cart" href="{{ url('/kosik') }}">
                        <i class="fas fa-shopping-cart"></i>
                        @php
                            $cart = session()->get('cart', []);
                            $cartCount = array_sum($cart);
                        @endphp
                        @if($cartCount > 0)
                            <span style="position: absolute; top: -5px; right: -5px; background: red; color: white; border-radius: 50%; min-width: 20px; height: 20px; font-size: 12px; display: flex; align-items: center; justify-content: center; padding: 0 5px;">{{ $cartCount }}</span> 
                        @endif
                    </a>

                   <!-- Mini košík -->
                    <div class="cart-menu">
                        <div class="triangle"></div>
                        
                        @php
                            
                            if (auth()->check()) {
                                $dbCartItems = \App\Models\CartItem::where('user_id', auth()->id())->with('book')->get();
                                $cart = [];
                                foreach ($dbCartItems as $item) {
                                    $cart[$item->book_id] = $item->quantity;
                                }
                                session()->put('cart', $cart);
                            } else {
                                $cart = session()->get('cart', []);
                            }
                            $cartTotal = 0;
                        @endphp
                        
                        <div class="cart-items">
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

                            <a href="{{  url('/objednavka') }}" class="btn-checkout" style="display: block; text-align: center; text-decoration: none; line-height: 30px;">Dokončiť</a>
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
                
                    <!-- KOMPLETNÉ MENU -->
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
                                                    <a href="{{ url('/?zaner='.$genre->slug) }}">
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
        <div style="background: #c4b5fd; color: white; padding: 15px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #ff6a91; color: white; padding: 15px; text-align: center;">
            {{ session('error') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer></footer>

</body>
</html>