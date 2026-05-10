@extends('layouts.app')

@section('title', 'Registrácia')

@section('content')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.querySelector('.register-box .toggle-password');
    const passwordInput = document.querySelector('.register-box #password');
    
    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    }
    
    // Klik na ikonu kalendára otvorí date picker
    const calendarBtn = document.querySelector('.calendar-btn');
    const birthdateInput = document.querySelector('#birthdate');
    
    if (calendarBtn && birthdateInput) {
        calendarBtn.addEventListener('click', function() {
            birthdateInput.showPicker();
        });
    }
});
</script>

<main class="register-page">
    <div class="register-container">
        <div class="register-box">
            <h2>Registrácia</h2>
            
            @if($errors->any())
                <div style="color: #ff6b6b; margin-bottom: 15px; font-size: 0.9rem;">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            
            <form class="register-form" method="POST" action="{{ url('/register') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">E-MAIL <span class="required">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="password">HESLO <span class="required">*</span></label>
                    <div class="password-input">
                        <input type="password" id="password" name="password" required>
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="meno">MENO <span class="required">*</span></label>
                    <input type="text" id="meno" name="name" value="{{ old('name') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="priezvisko">PRIEZVISKO <span class="required">*</span></label>
                    <input type="text" id="priezvisko" name="surname" value="{{ old('surname') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="birthdate">DÁTUM NARODENIA</label>
                    <div class="date-input">
                        <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" placeholder="dd. mm. rrrr">
                        <button type="button" class="calendar-btn">
                            <i class="fas fa-calendar-alt"></i>
                        </button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="telefon">TELEFÓN</label>
                    <input type="tel" id="telefon" name="phone" value="{{ old('phone') }}">
                </div>
                
                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="novinky" name="newsletter">
                        <label for="novinky">Prosím si posielať novinky na e-mail</label>
                    </div>
                    
                    <div class="checkbox-item">
                        <input type="checkbox" id="podmienky" name="terms" required>
                        <label for="podmienky">Mám viac ako 16 rokov a súhlasím so Všetkými obchodnými podmienkami.</label>
                    </div>
                    
                    <div class="checkbox-item">
                        <input type="checkbox" id="gdpr" name="gdpr" required>
                        <label for="gdpr">Súhlasím s ochranou osobných údajov</label>
                    </div>
                </div>
                
                <button type="submit" class="register-btn">ZAREGISTROVAŤ SA</button>
            </form>
        </div>

        <p class="login-link">
            <a href="{{ url('/login') }}">Späť na prihlásenie</a>
        </p>
    </div>
</main>
@endsection