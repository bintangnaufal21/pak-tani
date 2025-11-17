<!-- resources/views/auth/login.blade.php -->
<x-layoutAuth title="Login">
  <div class="page">
    <div class="card">
      <h1 class="title">Login</h1>

      <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input id="email" name="email" type="email" placeholder="you@example.com" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="••••••••" required>

        <button type="submit" class="btn-primary">Masuk</button>

        <p class="small-text">
          Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </p>
      </form>
    </div>
  </div>
</x-layoutAuth>
