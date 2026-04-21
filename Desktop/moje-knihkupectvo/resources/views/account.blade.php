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
            <div class="photo-controls">
                <a href="#" class="photo-link">ZMENIŤ OBRAZOK</a>
                <a href="#" class="photo-link">ODSTRÁNIŤ OBRAZOK</a>
            </div>
            <div class="profile-circle">
                <i class="fas fa-user" style="font-size: 60px; color: #999; display: flex; justify-content: center; align-items: center; height: 100%;"></i>
            </div>
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
                        <label for="priezvisko">PRIEZVISKO <span class="required">*</span></label>
                        <input type="text" id="priezvisko" name="surname" value="{{ auth()->user()->surname ?? '' }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="telefon">TELEFÓN <span class="required">*</span></label>
                        <input type="tel" id="telefon" name="phone" value="{{ auth()->user()->phone ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-MAIL <span class="required">*</span></label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="narodeniny">NARODENINY <span class="required">*</span></label>
                        <div class="date-input">
                            <input type="text" id="narodeniny" name="birthdate" placeholder="dd. mm. rrrr" value="{{ auth()->user()->birthdate ?? '' }}" required>
                            <i class="far fa-calendar calendar-icon"></i>
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
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="nove-heslo">NOVÉ HESLO</label>
                    <div class="password-input">
                        <input type="password" id="nove-heslo" name="new_password">
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="potvrdenie-hesla">POTVRDENIE NOVÉHO HESLA</label>
                    <div class="password-input">
                        <input type="password" id="potvrdenie-hesla" name="new_password_confirmation">
                        <button type="button" class="toggle-password">
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
    <div class="suggestions-section">
        <p>Tiež by sa vám mohlo páčiť:</p>
        
        <div class="rec-slider">
            <button class="rec-arrow left">
                <i class="fas fa-arrow-left"></i>
            </button>
            
            <div class="rec-books">
                <div class="rec-book-placeholder"></div>
                <div class="rec-book-placeholder"></div>
                <div class="rec-book-placeholder"></div>
                <div class="rec-book-placeholder"></div>
                <div class="rec-book-placeholder"></div>
            </div>
            
            <button class="rec-arrow right">
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
</main>
@endsection