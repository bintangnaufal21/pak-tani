<x-layoutAuth title="Register">
  <div class="page">
    <div class="card">
      <h1 class="title">Register</h1>

      <form action="{{ route('register') }}" method="POST">
        @csrf
        <label for="name">Nama Lengkap</label>
        <input id="name" name="name" type="text" placeholder="Nama lengkap" required>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" placeholder="you@example.com" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="Minimal 8 karakter" required>

        <label for="password_confirmation">Ulangi Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Ketik ulang password" required>

        <button type="submit" class="btn-primary">Daftar</button>

        <p class="small-text">
          Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </p>
      </form>
    </div>
  </div>
</x-layoutAuth>
