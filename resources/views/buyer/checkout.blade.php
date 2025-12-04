<x-layoutBuyer title="Checkout Buyer">
    <header class="header">
        <h2>Form Checkout</h2>
    </header>

    <div class="checkout-wrapper max-w-6xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT FORM --}}
        <div class="left-form lg:col-span-2 bg-white p-6 rounded shadow">
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="checkout-form" action="{{ route('buyer.checkout.place') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                {{-- INFO PENERIMA --}}
                <h2 class="text-xl font-semibold mb-4">Informasi Penerima</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label>Nama Depan*</label>
                        <input name="receiver_first_name" value="{{ old('receiver_first_name', $user->name ?? '') }}"
                            class="w-full border rounded p-2" required />
                    </div>

                    <div>
                        <label>Nama Belakang</label>
                        <input name="receiver_last_name" value="{{ old('receiver_last_name') }}"
                            class="w-full border rounded p-2" />
                    </div>

                    <div class="md:col-span-2">
                        <label>Alamat Lengkap*</label>
                        <input name="shipping_address" value="{{ old('shipping_address') }}"
                            class="w-full border rounded p-2" required />
                    </div>

                    <div>
                        <label>Kota*</label>
                        <input name="city" value="{{ old('city') }}" class="w-full border rounded p-2" />
                    </div>

                    <div>
                        <label>Kode Pos*</label>
                        <input name="postal_code" value="{{ old('postal_code') }}" class="w-full border rounded p-2" />
                    </div>

                    <div>
                        <label>Provinsi*</label>
                        <input name="province" value="{{ old('province') }}" class="w-full border rounded p-2" />
                    </div>

                    <div>
                        <label>Negara*</label>
                        <input name="country" value="{{ old('country', 'Indonesia') }}"
                            class="w-full border rounded p-2" />
                    </div>
                </div>

                {{-- CONTACT --}}
                <h3 class="mt-6 font-semibold">Kontak</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label>Email*</label>
                        <input name="receiver_email" type="email"
                            value="{{ old('receiver_email', $user->email ?? '') }}" class="w-full border rounded p-2"
                            required />
                    </div>

                    <div>
                        <label>No HP*</label>
                        <input name="receiver_phone" value="{{ old('receiver_phone') }}"
                            class="w-full border rounded p-2" required />
                    </div>
                </div>

                <hr class="my-6">

                {{-- PAYMENT PROOF --}}
                <h3 class="font-semibold mb-2">Bukti Pembayaran (upload)</h3>
                <input type="file" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" class="mb-4" />

                {{-- IMPORTANT HIDDEN FIELDS --}}
                <input type="hidden" name="shipping_method" id="shipping_method_input" value="reguler">
                <input type="hidden" name="shipping_cost" id="shipping_cost_input" value="10000">
            </form>
        </div>




        {{-- RIGHT SUMMARY --}}
        <div class="right-summary space-y-4">

            {{-- PAYMENT METHOD --}}
            <div class="bg-white p-5 rounded shadow">
                <h3 class="font-semibold mb-2">Metode Pembayaran</h3>
                <p class="text-sm">Transfer ke:</p>
                <div class="mt-3 text-sm">
                    <strong>Bank BCA</strong><br>
                    Rekening: <code>1234567890</code><br>
                    a.n. Pak Tani Official
                </div>
            </div>

            {{-- SHIPPING METHOD --}}
            <div class="bg-white p-5 rounded shadow">
                <h3 class="font-semibold mb-3">Metode Pengiriman</h3>

                <div id="shipping-options" class="space-y-3 text-sm">

                    <label class="block p-3 border rounded flex justify-between cursor-pointer">
                        <div>
                            <strong>Reguler</strong><br>
                            <span class="text-xs text-gray-500">3–5 hari</span>
                        </div>
                        <div>
                            Rp <span>10.000</span>
                            <input type="radio" name="shipping" value="reguler" data-cost="10000">
                        </div>
                    </label>

                    <label class="block p-3 border rounded flex justify-between cursor-pointer">
                        <div>
                            <strong>Express</strong><br>
                            <span class="text-xs text-gray-500">1–2 hari</span>
                        </div>
                        <div>
                            Rp <span>20.000</span>
                            <input type="radio" name="shipping" value="express" data-cost="20000">
                        </div>
                    </label>

                    <label class="block p-3 border rounded flex justify-between cursor-pointer">
                        <div>
                            <strong>Instant</strong><br>
                            <span class="text-xs text-gray-500">Tiba hari ini</span>
                        </div>
                        <div>
                            Rp <span>30.000</span>
                            <input type="radio" name="shipping" value="instant" data-cost="30000">
                        </div>
                    </label>

                </div>
            </div>

            {{-- ORDER SUMMARY --}}
            <div class="bg-white p-5 rounded shadow">
                <h3 class="font-semibold mb-3">Ringkasan Pesanan</h3>

                <div class="text-sm space-y-2">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>Rp <span id="subtotal_text">{{ number_format($subtotal ?? 0, 0, ',', '.') }}</span></span>
                    </div>

                    <div class="flex justify-between">
                        <span>Ongkir</span>
                        <span>Rp <span id="shipping_text">10.000</span></span>
                    </div>

                    <hr>

                    <div class="flex justify-between font-semibold">
                        <span>Total</span>
                        <span>Rp <span
                                id="total_text">{{ number_format(($subtotal ?? 0) + 10000, 0, ',', '.') }}</span></span>
                    </div>
                </div>

                <button id="submit-order-btn" class="w-full mt-4 bg-green-600 text-white px-4 py-2 rounded">
                    Kirim Pesanan
                </button>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script>
        (function() {
            const subtotal = Number(@json($subtotal ?? 0));

            const shippingInputs = document.querySelectorAll("input[name='shipping']");
            const methodInput = document.getElementById("shipping_method_input");
            const costInput = document.getElementById("shipping_cost_input");

            const shippingText = document.getElementById("shipping_text");
            const subtotalText = document.getElementById("subtotal_text");
            const totalText = document.getElementById("total_text");

            const checkoutForm = document.getElementById("checkout-form");
            const submitBtn = document.getElementById("submit-order-btn");

            function formatID(n) {
                return n.toLocaleString("id-ID");
            }

            function updateTotals(cost) {
                shippingText.textContent = formatID(cost);
                totalText.textContent = formatID(subtotal + cost);
                subtotalText.textContent = formatID(subtotal);
            }

            // default reguler
            updateTotals(10000);

            shippingInputs.forEach(radio => {
                radio.addEventListener("change", function() {
                    methodInput.value = this.value;
                    costInput.value = this.dataset.cost;
                    updateTotals(Number(this.dataset.cost));
                });
            });

            submitBtn.addEventListener("click", function() {
                // jika belum klik apa pun, ambil default reguler
                if (!document.querySelector("input[name='shipping']:checked")) {
                    document.querySelector("input[value='reguler']").checked = true;
                }

                checkoutForm.submit();
            });
        })();
    </script>
</x-layoutBuyer>
