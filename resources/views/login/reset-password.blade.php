@extends('layoutAuth.main')

@section('contentAuth')
<link rel="stylesheet" href="{{ asset('templateAdmin/dist/css/login-modern.css') }}">

<main class="auth-shell">
  <section class="auth-visual">
    <div class="visual-head">ACCOUNT RECOVERY</div>
    <div class="visual-copy">
      <h2>Create New<br>Password</h2>
      <p>Gunakan password yang kuat agar akun admin tetap aman.</p>
    </div>
  </section>

  <section class="auth-form">
    <div class="brand">
      <span class="brand-mark"></span>
      <span>Cogie</span>
    </div>

    <div class="welcome">
      <h1>Reset Password</h1>
      <p>Set your new password for {{ $email }}</p>
    </div>

    <form class="login-form" action="{{ route('password.admin.reset') }}" method="POST" novalidate>
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <input type="hidden" name="email" value="{{ $email }}">

      <div class="feedback-block">
        @if (session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
      </div>

      <div class="field">
        <label for="password">New Password</label>
        <input id="password" type="password" placeholder="Enter new password" name="password" required>
        @error('password')
          <div class="invalid-note">{{ $message }}</div>
        @enderror
      </div>

      <div class="field">
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" placeholder="Confirm new password" name="password_confirmation" required>
      </div>

      <button class="btn-main" type="submit">Update Password</button>
    </form>

    <p class="signup">
      Back to <a href="{{ route('login') }}">Login</a>
    </p>
  </section>
</main>
@endsection

