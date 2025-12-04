<x-layoutBuyer title="Buka Toko">
    <section class="page-center">
        <div class="store-card">

            {{-- ICON + TITLE --}}
            <div class="store-header">
                <div class="store-icon">
                    🌾
                </div>
                <div>
                    <h1>Buka Toko</h1>
                    <p>Jadikan hasil panenmu bisa dibeli banyak orang lewat Pak Tani.</p>
                </div>
            </div>

            {{-- ALERT JIKA ADA ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM BUKA TOKO --}}
            <form action="{{ route('buyer.buka-toko.store') }}" method="POST" class="store-form">
                @csrf

                <div class="form-group">
                    <label for="store_name">Nama Toko</label>
                    <input id="store_name" name="store_name" type="text"
                        placeholder="Contoh: Toko Sayur Segar Bintang"
                        value="{{ old('store_name', 'Toko ' . auth()->user()->name) }}" required>
                    <small>Gunakan nama yang mudah diingat pembeli.</small>
                </div>

                <button type="submit" class="btn btn-primary btn-full">
                    🚀 Buka Toko Sekarang
                </button>

                <p class="helper-text">
                    Dengan membuka toko, akunmu akan berubah menjadi <strong>Seller</strong>
                    dan kamu bisa menambahkan produk panen untuk dijual.
                </p>
            </form>
        </div>
    </section>

    <style>
.page-center {
    min-height: calc(100vh - 60px);
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 2rem 1rem 4.5rem;
    background: radial-gradient(circle at top, #bbf7d0 0, #ffffff 40%, #f9fafb 100%);
}

/* ==== CARD UTAMA ==== */
.store-card {
    width: 100%;
    max-width: 420px;
    background: #ffffff;
    border-radius: 18px;
    padding: 1.5rem 1.4rem 1.2rem;
    box-shadow: 0 16px 35px rgba(15,23,42,0.14);
    border: 1px solid #e2e8f0;
    overflow: hidden; /* antisipasi meluber */
}

/* ==== HEADER ==== */
.store-header {
    display: flex;
    gap: .75rem;
    align-items: center;
    margin-bottom: 1.1rem;
}

.store-icon {
    width: 42px;
    height: 42px;
    border-radius: 14px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.4rem;
    background: #ecfdf5;
    border: 1px solid #bbf7d0;
}

.store-header h1 {
    margin: 0;
    font-size: 1.28rem;
    font-weight: 700;
    color: #033422;
}

.store-header p {
    margin: 2px 0 0;
    font-size: .84rem;
    color: #465057;
    font-weight: 500;
}

/* ==== FORM ==== */
.store-form { display: flex; flex-direction: column; gap: .8rem; }

/* ENSURE INPUT TIDAK LEWAT CARD 🔥 */
.store-card input,
.store-card .form-group input {
    width: 100%;
    max-width: 100%;
    box-sizing: border-box; /* FIX PENUH */
}

.form-group label {
    font-size: .85rem;
    color: #374151;
    font-weight: 600;
    margin-bottom: .2rem;
}

.form-group input {
    padding: .55rem .75rem;
    border-radius: 11px;
    border: 1px solid #d1d5db;
    background: #f9fafb;
    font-size: .92rem;
    transition: .18s;
}

.form-group input:focus {
    border-color: #22c55e;
    box-shadow: 0 0 0 2px rgba(34,197,94,0.25);
    background: #ffffff;
}

.form-group small {
    font-size: .75rem;
    color: #6b7280;
    margin-top: .2rem;
    display: block;
}

/* ==== BUTTON ==== */
.btn {
    border-radius: 999px;
    padding: .55rem 1rem;
    font-size: .92rem;
    font-weight: 700;
    cursor: pointer;
    transition: .2s;
    border: none;
    display: flex;
    justify-content: center;
    align-items: center;
}
.btn-full{ width:100%; }

.btn-primary {
    background: linear-gradient(135deg,#22c55e,#16a34a);
    color:#fff;
    box-shadow:0 10px 22px rgba(22,163,74,0.45);
}
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow:0 14px 28px rgba(22,163,74,0.55);
}

.helper-text {
    font-size:.78rem;
    color:#6b7280;
    margin-top:.35rem;
    text-align:center;
}
</style>

</x-layoutBuyer>
