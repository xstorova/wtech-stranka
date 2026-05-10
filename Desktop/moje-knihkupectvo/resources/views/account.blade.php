@extends('layouts.app')

@section('title', 'Nastavenie účtu')

@section('content')
<main>
    <div class="section-title">
        <h2>Nastavenie účtu</h2>
    </div>

    <!-- Sekcia profilu a formulára -->
    <div class="settings-container">
        <div class="profile-photo-column">

            {{-- Profilový obrázok --}}
            <div class="profile-circle" id="avatarPreview" style="overflow: hidden;">
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/'.auth()->user()->avatar) }}"
                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                @else
                    <i class="fas fa-user" style="font-size: 60px; color: #999; display: flex; justify-content: center; align-items: center; height: 100%;"></i>
                @endif
            </div>

            {{-- Zmeniť obrázok --}}
            <form method="POST" action="{{ url('/account/avatar') }}" enctype="multipart/form-data" style="margin-top: 10px;" id="avatarForm">
                @csrf
                <label style="cursor: pointer;">
                    <span class="photo-link">ZMENIŤ OBRÁZOK</span>
                    <input type="file" name="avatar" accept="image/*" style="display: none;" id="avatarInput">
                </label>
            </form>

            {{-- Odstrániť obrázok --}}
            @if(auth()->user()->avatar)
            <form method="POST" action="{{ url('/account/avatar') }}" style="margin-top: 5px;" id="removeAvatarForm">
                @csrf
                @method('DELETE')
                <button type="submit" class="photo-link"
                        style="background: none; border: none; cursor: pointer; padding: 0;"
                        onclick="return confirm('Naozaj odstrániť obrázok?')">
                    ODSTRÁNIŤ OBRÁZOK
                </button>
            </form>
            @endif

        </div>

        <!-- Pravý stĺpec - formulár osobných údajov -->
        <div class="settings-form-box">
            <form class="account-form" method="POST" action="{{ url('/account') }}">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label for="meno">MENO <span class="required">*</span></label>
                        <input type="text" id="meno" name="name" value="{{ auth()->user()->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="priezvisko">PRIEZVISKO</label>
                        <input type="text" id="priezvisko" name="surname" value="{{ auth()->user()->surname ?? '' }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="telefon">TELEFÓN</label>
                        <input type="tel" id="telefon" name="phone" value="{{ auth()->user()->phone ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="email">E-MAIL <span class="required">*</span></label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="birthdate">DÁTUM NARODENIA</label>
                        <div class="date-input">
                            <input type="date" id="birthdate" name="birthdate" value="{{ auth()->user()->birthdate ? auth()->user()->birthdate->format('Y-m-d') : '' }}">
                            <button type="button" class="calendar-btn">
                            </button>
                        </div>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn-save">ULOŽIŤ ZMENY</button>
                    <a href="{{ url('/logout') }}" class="btn-logout" style="text-decoration: none; display: inline-block; text-align: center; line-height: 35px;">ODHLÁSIŤ SA</a>
                </div>
            </form>
        </div>
    </div>

    <hr class="separator">

    <!-- Sekcia zmeny hesla -->
    <div class="section-title">
        <h2>Heslo a prihlasovanie</h2>
    </div>

    <div class="password-settings-box">
        <form class="account-form" method="POST" action="{{ url('/account/password') }}">
            @csrf
            @method('PUT')
            
            <div class="form-row">
                <div class="form-group">
                    <label for="povodne-heslo">PÔVODNÉ HESLO</label>
                    <div class="password-input">
                        <input type="password" id="povodne-heslo" name="current_password">
                        <button type="button" class="toggle-password" onclick="togglePwd(this)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <span style="color: #ff6b6b; font-size: 0.85rem; margin-top: 5px; display: block;">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="nove-heslo">NOVÉ HESLO</label>
                    <div class="password-input">
                        <input type="password" id="nove-heslo" name="new_password">
                        <button type="button" class="toggle-password" onclick="togglePwd(this)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('new_password')
                        <span style="color: #ff6b6b; font-size: 0.85rem; margin-top: 5px; display: block;">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="potvrdenie-hesla">POTVRDENIE NOVÉHO HESLA</label>
                    <div class="password-input">
                        <input type="password" id="potvrdenie-hesla" name="new_password_confirmation">
                        <button type="button" class="toggle-password" onclick="togglePwd(this)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn-save" style="margin-top: 20px;">ZMENIŤ HESLO</button>
        </form>
    </div>

    <hr class="separator">

    <!-- Odporúčané knihy -->
    @if(isset($carouselBooks) && $carouselBooks->count() > 0)
    <section class="recommendations">
        <div class="container">
            <h3>Tiež by sa vám mohlo páčiť:</h3>
            <div class="rec-slider">
                <button class="rec-arrow left" type="button" aria-label="Doľava">
                    <i class="fas fa-arrow-left"></i>
                </button>

                <div class="rec-books" id="recBooksAccount">
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
        const box = document.getElementById('recBooksAccount');
        const left  = box.closest('.rec-slider').querySelector('.rec-arrow.left');
        const right = box.closest('.rec-slider').querySelector('.rec-arrow.right');

        const getStep = () => {
            const card = box.querySelector('a');
            if (!card) return 150;
            const gap = parseInt(window.getComputedStyle(box).gap) || 15;
            return card.offsetWidth + gap;
        };

        left.addEventListener('click', () => box.scrollBy({ left: -getStep(), behavior: 'smooth' }));
        right.addEventListener('click', () => box.scrollBy({ left: getStep(), behavior: 'smooth' }));
    })();
    </script>
    @endif
</main>

<script>
function togglePwd(btn) {
    const input = btn.closest('.password-input').querySelector('input');
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');
    const avatarForm = document.getElementById('avatarForm');

    if (avatarInput && avatarPreview) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    avatarPreview.innerHTML = '<img src="' + event.target.result + '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">';
                };
                reader.readAsDataURL(file);
                
                setTimeout(() => {
                    avatarForm.submit();
                }, 300);
            }
        });
    }
});
</script>
@endsection