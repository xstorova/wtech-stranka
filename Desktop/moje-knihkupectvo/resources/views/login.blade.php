@extends('layouts.app')

@section('title', 'Prihlásenie')

@section('content')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.querySelector('.login-box .toggle-password');
    const passwordInput = document.querySelector('.login-box #password');
    
    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    }
});
</script>

<main class="login-page">
    <div class="login-container">
        <div class="login-box">
            <h2>Prihlásenie</h2>
            
            @if($errors->any())
                <div style="color: #ff6b6b; margin-bottom: 15px; font-size: 0.9rem;">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <form class="login-form" method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">E-MAIL</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}">
                </div>
                
                <div class="form-group">
                    <label for="password">HESLO</label>
                    <div class="password-input">
                        <input type="password" id="password" name="password">
                        <button type="button" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Zapamätať prihlásenie</label>
                </div>
                
                <button type="submit" class="login-btn">PRIHLÁSIŤ SA</button>
                
                <a href="#" class="forgot-password">Zabudli ste heslo?</a>
            </form>
        </div>
        
        <p class="register-link">
            Nemáte u nás účet? <a href="{{ url('/register') }}">Zaregistrujte sa</a>
        </p>
    </div>
</main>
@endsection