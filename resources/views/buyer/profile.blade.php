<x-layoutBuyer title="Profil Buyer">
    <section class="profile-container">

        {{-- DATA USER --}}

        <div class="user-info">
            <x-notification-bell />
            <h2>{{ auth()->user()->name }}</h2>
            <p>{{ auth()->user()->email }}</p>
            <p class="role-text">Role: {{ ucfirst(auth()->user()->role) }}</p>
        </div>

        </div>

        {{-- AKSI BERDASARKAN ROLE --}}
        <div class="profile-actions">

            {{-- Jika masih BUYER, tampilkan tombol Buka Toko --}}
            @if (auth()->user()->role === 'buyer')
                <a href="{{ route('buyer.buka-toko') }}" class="btn-primary">
                    🌱 Buka Toko & Jadi Seller
                </a>
            @endif

            {{-- Jika sudah SELLER, tampilkan tombol ke Dashboard Seller --}}
            @if (auth()->user()->role === 'seller')
                <a href="{{ route('seller.dashboard') }}" class="btn-secondary">
                    🏬 Pergi ke Dashboard Seller
                </a>
            @endif

            {{-- Tombol logout --}}
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="btn-logout">
                    🚪 Logout
                </button>
            </form>
        </div>

    </section>
</x-layoutBuyer>
