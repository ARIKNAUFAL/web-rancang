@extends('layoutAuth.main')

@section('contentAuth')
<link rel="stylesheet" href="{{ asset('templateAdmin/dist/css/login-modern.css') }}">

<main class="auth-shell">
  <section class="auth-visual">
    <div class="visual-head">A WISE QUOTE</div>
    <div class="visual-copy">
      <h2>Get Everything<br>You Want</h2>
      <p>You can get everything you want if you work hard, trust the process, and stick to the plan.</p>
    </div>
  </section>

  <section class="auth-form">
    <div class="brand">
      <span class="brand-mark"></span>
      <span>Cogie</span>
    </div>

    <div class="welcome">
      <h1>Welcome Back</h1>
      <p>Enter your username and password to access your account</p>
    </div>

    <form class="login-form" action="/prosesLogin" method="POST" novalidate>
      @csrf

      <div class="feedback-block">
        @if (session('error'))
          <div class="alert alert-danger">
            <strong>Login Failed.</strong> {{ session('error') }}
          </div>
        @endif
      </div>

      <div class="field">
        <label for="username">Username</label>
        <input id="username" type="text" placeholder="Enter your username" name="username" value="{{ old('username') }}" required>
        @error('username')
          <div class="invalid-note">{{ $message }}</div>
        @enderror
      </div>

      <div class="field">
        <label for="password">Password</label>
        <div class="pass-wrap">
          <input id="password" type="password" placeholder="Enter your password" name="password" required>
          <button class="pass-toggle" type="button" aria-label="Toggle password" onclick="togglePassword()">
            <i class="fa fa-eye"></i>
          </button>
        </div>
        @error('password')
          <div class="invalid-note">{{ $message }}</div>
        @enderror
      </div>

      <div class="meta-row">
        <label class="check">
          <input type="checkbox" name="remember" disabled>
          <span>Remember me</span>
        </label>
        <a class="forgot" href="{{ route('password.admin.request') }}">Forgot Password</a>
      </div>

      <button class="btn-main" type="submit">Sign In</button>
      <button class="btn-oauth" type="button" disabled><span>G</span>Sign In with Google</button>
    </form>

    <p class="signup">
      Don't have an account? <a href="{{ route('index') }}">Sign Up</a>
    </p>
  </section>
</main>

<script>
  function togglePassword() {
    var field = document.getElementById('password');
    if (!field) return;
    field.type = field.type === 'password' ? 'text' : 'password';
  }
</script>
@endsection
