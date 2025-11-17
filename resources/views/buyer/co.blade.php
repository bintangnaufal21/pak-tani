<x-layoutBuyer title="Checkout Buyer">
  <!-- HEADER -->
  <header class="header">
    <h2>Form Checkout mu</h2>
  </header>

<div class="checkout-wrapper">

  <!-- ================= LEFT SIDE – FORM ================= -->
  <div class="left-form">

    <h2>Informasi Penerima</h2>

    <div class="form-grid">

      <div class="form-group">
        <label>Nama Depan*</label>
        <input type="text">
      </div>

      <div class="form-group">
        <label>Nama Belakang*</label>
        <input type="text">
      </div>

      <div class="form-group full">
        <label>Alamat Lengkap*</label>
        <input type="text">
      </div>

      <div class="form-group full">
        <label>Detail Tambahan (Opsional)</label>
        <input type="text">
      </div>

      <div class="form-group">
        <label>Kota*</label>
        <input type="text">
      </div>

      <div class="form-group">
        <label>Kode Pos*</label>
        <input type="text">
      </div>

      <div class="form-group">
        <label>Provinsi*</label>
        <input type="text">
      </div>

      <div class="form-group">
        <label>Negara*</label>
        <input type="text" value="Indonesia">
      </div>

      <h3 class="subtitle full">Kontak</h3>

      <div class="form-group">
        <label>Email*</label>
        <input type="email">
      </div>

      <div class="form-group">
        <label>No HP*</label>
        <input type="text">
      </div>
    </div>

    <hr class="divider">

    <!-- ================= Upload Bukti Pembayaran ================= -->
    <h2>Bukti Pembayaran</h2>
    <p class="note">Upload bukti transfer (JPG, PNG, PDF).</p>

    <div class="form-group full">
      <input type="file" accept=".jpg,.jpeg,.png,.pdf" class="upload-box">
    </div>

  </div>

  <!-- ================= RIGHT SIDE – SHIPPING & TOTAL ================= -->
  <div class="right-summary">

    <h2>Metode Pengiriman</h2>

    <div class="shipping-box">
      <label class="ship-option">
        <input type="radio" name="shipping" checked>
        <div class="ship-info">
          <strong>Reguler</strong>
          <span>3–5 hari kerja</span>
        </div>
        <p class="price">Rp 10.000</p>
      </label>

      <label class="ship-option">
        <input type="radio" name="shipping">
        <div class="ship-info">
          <strong>Express</strong>
          <span>1–2 hari</span>
        </div>
        <p class="price">Rp 20.000</p>
      </label>

      <label class="ship-option">
        <input type="radio" name="shipping">
        <div class="ship-info">
          <strong>Instant</strong>
          <span>Tiba hari ini</span>
        </div>
        <p class="price">Rp 30.000</p>
      </label>
    </div>

    <h2>Ringkasan Pesanan</h2>

    <div class="summary-box">
      <div class="row">
        <span>Subtotal</span>
        <strong>Rp 18.000</strong>
      </div>
      <div class="row">
        <span>Pengiriman</span>
        <strong>Rp 10.000</strong>
      </div>
      <div class="row total">
        <span>Total</span>
        <strong>Rp 28.000</strong>
      </div>

      <button class="btn-pay">Kirim Pesanan</button>
    </div>
</div>
</x-layoutBuyer>
