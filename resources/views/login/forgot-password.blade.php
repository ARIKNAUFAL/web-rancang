@extends('layoutAuth.main')

@section('contentAuth')
<link rel="stylesheet" href="{{ asset('templateAdmin/dist/css/login-modern.css') }}">

<main class="auth-shell">
  <section class="auth-visual">
    <div class="visual-head">ACCOUNT RECOVERY</div>
    <div class="visual-copy">
      <h2>Reset<br>Your Password</h2>
      <p>Masukkan email admin Anda. Jika terdaftar, kami akan kirim link reset password.</p>
    </div>
  </section>

  <section class="auth-form">
    <div class="brand">
      <span class="brand-mark"></span>
      <span>Cogie</span>
    </div>

    <div class="welcome">
      <h1>Forgot Password</h1>
      <p>Enter your admin email to receive a reset link</p>
    </div>

    <form class="login-form" action="{{ route('password.admin.email') }}" method="POST" novalidate>
      @csrf

      <div class="feedback-block">
        @if (session('status'))
          <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if (session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('reset_link_preview'))
          <div class="alert alert-warning" style="word-break: break-all;">
            Dev link preview:
            <a href="{{ session('reset_link_preview') }}">{{ session('reset_link_preview') }}</a>
          </div>
        @endif
      </div>

      <div class="field">
        <label for="email">Admin Email</label>
        <input id="email" type="email" placeholder="Enter your admin email" name="email" value="{{ old('email') }}" required>
        @error('email')
          <div class="invalid-note">{{ $message }}</div>
        @enderror
      </div>

      <button class="btn-main" type="submit">Send Reset Link</button>
    </form>

    <p class="signup">
      Back to <a href="{{ route('login') }}">Login</a>
    </p>
  </section>
</main>
@endsection

