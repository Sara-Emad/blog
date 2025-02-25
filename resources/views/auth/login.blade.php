@extends('layouts.app')

@section('content')
<style>
    .auth-bg {
        background: linear-gradient(160deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.18);
        overflow: hidden;
    }
    .auth-header {
        background: linear-gradient(45deg, #6c757d, #495057);
        color: white !important;
        padding: 1.5rem;
        text-align: center;
        font-weight: 300;
        letter-spacing: 1px;
        border-radius: 15px 15px 0 0;
    }
    .soft-input {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 12px 20px;
        transition: all 0.3s ease;
    }
    .soft-input:focus {
        border-color: #adb5bd;
        box-shadow: 0 0 0 3px rgba(108, 117, 125, 0.1);
    }
    .earth-btn {
        background: #6c757d;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    .earth-btn:hover {
        background: #5a6268;
        transform: translateY(-1px);
    }
    .link-muted {
        color: #6c757d !important;
        text-decoration: none;
        transition: color 0.2s;
    }
    .link-muted:hover {
        color: #495057 !important;
    }
    .input-icon {
        position: relative;
    }
    .input-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        opacity: 0.7;
    }
    .error-msg {
        background: #fff3f3;
        border: 1px solid #ffd6d6;
        color: #dc3545;
        padding: 12px;
        border-radius: 8px;
        margin: 10px 0;
    }
    .deco-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background: url("data:image/svg+xml,%3Csvg viewBox='0 0 1440 320' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill='%23e9ecef' fill-opacity='0.3' d='M0,128L48,117.3C96,107,192,85,288,101.3C384,117,480,171,576,176C672,181,768,139,864,128C960,117,1056,139,1152,138.7C1248,139,1344,117,1392,106.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
    }
</style>

<div class="auth-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="glass-card">
                    <div class="auth-header">
                        <h2 class="mb-0">{{ __('Welcome Back') }}</h2>
                        <p class="mb-0 mt-2 small opacity-75">Sign in to continue</p>
                    </div>

                    <div class="card-body p-4 p-lg-5 position-relative">
                        <div class="deco-wave"></div>
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Input -->
                            <div class="mb-4 input-icon">
                                <i class="bi bi-person-circle"></i>
                                <input id="email" type="email" 
                                    class="form-control soft-input @error('email') is-invalid @enderror" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    placeholder="{{ __('Email Address') }}"
                                    required 
                                    autocomplete="email" 
                                    autofocus>
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4 input-icon">
                                <i class="bi bi-key-fill"></i>
                                <input id="password" type="password" 
                                    class="form-control soft-input @error('password') is-invalid @enderror" 
                                    name="password" 
                                    placeholder="{{ __('Password') }}"
                                    required 
                                    autocomplete="current-password">
                            </div>

                            @error('email')
                                <div class="error-msg">
                                    <i class="bi bi-exclamation-circle me-2"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            @error('password')
                                <div class="error-msg">
                                    <i class="bi bi-exclamation-circle me-2"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                        type="checkbox" 
                                        name="remember" 
                                        id="remember" 
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label small text-muted" for="remember">
                                        {{ __('Keep me logged in') }}
                                    </label>
                                </div>
                                
                                @if (Route::has('password.request'))
                                    <a class="link-muted small" href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div>

                            <div class="d-grid mb-4">
                                <button type="submit" class="earth-btn">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    {{ __('Sign In') }}
                                </button>
                            </div>

                            <div class="text-center small text-muted">
                                New here? 
                                <a class="link-muted" href="{{ route('register') }}">
                                    Create account
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection