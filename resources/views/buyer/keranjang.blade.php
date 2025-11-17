<x-layoutBuyer title="Keranjang Saya">
  <header class="top-header">
    <h2>Keranjang Saya</h2>
  </header>

<div class="cart-wrapper">

  <!-- PRODUK -->
  <div class="cart-container">
      <div class="cart-item">
        <img src="/images/paprika.jpeg" alt="Paprika">
        <div class="info">
          <h3>Paprika</h3>
          <div class="price">Rp 8.000</div>
        </div>
        <div class="qty-box">
          <button>-</button>
          <span>1</span>
          <button>+</button>
        </div>
      </div>

      <div class="cart-item">
        <img src="/images/timun.jpeg" alt="Timun">
        <div class="info">
          <h3>Timun</h3>
          <div class="price">Rp 10.000</div>
        </div>
        <div class="qty-box">
          <button>-</button>
          <span>1</span>
          <button>+</button>
        </div>
      </div>



      <!-- tambahkan item lainnya -->
  </div>

  <!-- SUMMARY -->
  <div class="summary-box">
      <h3>Order Summary</h3>

      <div class="summary-line"><span>Sub Total</span><span>Rp 18.000</span></div>
      <div class="summary-line"><span>Delivery fee</span><span>Rp 10.000</span></div>

      <hr>

      <div class="summary-total"><span>Total</span><span>Rp 28.000</span></div>

      <a href="{{ route('buyer.co')}}" class="checkout-btn">Checkout Now</a>
  </div>
</div>
</x-layoutBuyer>
