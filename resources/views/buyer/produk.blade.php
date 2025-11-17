<x-layoutBuyer title="Produk Pertanian">

  <!-- HEADER -->
  <header class="header">
    <h2>Produk Pertanian</h2>
    <p>Ayo lihat dan pilih segala hasil pertanian terbaik dari para petani kami</p>
  </header>

  <!-- PRODUCT LIST -->
  <section class="product-list">
    <div class="product-card">
      <img src="{{ asset('images/paprika.jpeg')}}" alt="Paprika">
      <h3>Paprika</h3>
      <p class="price">Rp 8.000 / kg</p>
      <a href="{{ route('dp.paprika')}}" class="btn-detail">Lihat Detail</a>
    </div>
  </section>
</x-layoutBuyer>
