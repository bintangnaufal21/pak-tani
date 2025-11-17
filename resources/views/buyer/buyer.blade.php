<x-layoutBuyer title="Beranda Buyer">
<!-- HERO / BANNER -->
<header class="hero">
  <div class="hero-text">
    <h1>AGRO MART</h1>
    <p>Grow your agro's with us</p>
    <a href="{{ route('buyer.produk')}}" class="btn-shop">Shop Now</a>
  </div>
  <img src="{{ asset('images/1.png') }}" alt="Organic Food">
</header>

<!-- BANNER SECTION -->
<section class="banner-section">
  <div class="banner-card">
    <img src="{{ asset('images/2.jpeg') }}" alt="Banner 2">
  </div>
  <div class="banner-card">
    <img src="{{ asset('images/3.jpeg') }}" alt="Banner 3">
  </div>
</section>

<!-- PRODUCT LIST -->
<section class="products">
  <h2>Our Products</h2>
  <div class="product-grid">
    <div class="card">
      <img src="{{ asset('images/timun.jpeg') }}" alt="Timun">
      <h4>Timun</h4>
      <p class="price">Rp 15.000</p>
    </div>
    <div class="card">
      <img src="{{ asset('images/wortel.jpeg') }}" alt="Wortel">
      <h4>Wortel</h4>
      <p class="price">Rp 10.000</p>
    </div>
    <div class="card">
      <img src="{{ asset('images/sawiputih.jpeg') }}" alt="Sawi Putih">
      <h4>Sawi Putih</h4>
      <p class="price">Rp 25.000</p>
    </div>
  </div>
</section>
</x-layoutBuyer>
