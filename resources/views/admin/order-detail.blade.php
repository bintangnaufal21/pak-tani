{{-- resources/views/admin/order-detail.blade.php --}}
<x-layoutAdmin title="Detail Pesanan — {{ $order->order_code }}">

    <main class="main">
        <div class="container">

            {{-- TOP: header + actions --}}
            <div class="top-row">
                <div class="title-block">
                    <h1>Detail Pesanan</h1>
                    <p class="muted">Kode: <strong>{{ $order->order_code }}</strong> • Dibuat:
                        {{ $order->created_at->format('d M Y H:i') }}</p>
                    <p class="muted">Pemesan:
                        <strong>{{ $order->receiver_name ?? ($order->user->name ?? '-') }}</strong>
                    </p>
                </div>

                <div class="actions">
                    <form action="{{ route('admin.orders.verify', $order->id) }}" method="POST"
                        onsubmit="return confirm('Set pesanan ini LUNAS?');">
                        @csrf
                        <button class="btn green">✔ Approve</button>
                    </form>

                    <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST"
                        onsubmit="return confirm('Tolak pembayaran ini?');">
                        @csrf
                        <button class="btn red">✖ Reject</button>
                    </form>
                </div>
            </div>

            <div class="grid">

                {{-- LEFT: produk + payment proof --}}
                <section class="card main-card">
                    <div class="section-header">
                        <h2>Daftar Produk</h2>
                    </div>

                    <div class="table-wrap">
                        <table class="item-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th class="center">Qty</th>
                                    <th class="right">Harga</th>
                                    <th class="right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td class="product-cell">
                                            <div class="product-name">{{ $item->product->name ?? '-' }}</div>
                                            <div class="product-sub muted">{{ $item->product->unit ?? '' }}</div>
                                        </td>
                                        <td class="center">{{ $item->quantity }}</td>
                                        <td class="right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- ====== BUKTI PEMBAYARAN (diperbarui) ====== --}}
                    <div class="section mt-6">
                        <h3 class="small-title">Bukti Pembayaran</h3>

                        @if ($order->payment_proof_path)
                            @php
                                $proofUrl = asset('storage/' . $order->payment_proof_path);
                                $filename = basename($order->payment_proof_path);
                            @endphp

                            <div class="proof-wrap">
                                <a href="#" id="proof-open" title="Klik untuk lihat lebih besar">
                                    <img id="proof-thumb" src="{{ $proofUrl }}" alt="Bukti Pembayaran" />
                                </a>

                                <div class="proof-meta">
                                    <div><strong>Metode Pembayaran:</strong>
                                        {{ ucfirst(str_replace('_', ' ', $order->payment_method ?? 'bank_transfer')) }}
                                    </div>
                                    <div style="margin-top:6px;"><strong>Status Pembayaran:</strong>
                                        <span
                                            class="badge {{ $order->payment_status == 'paid' ? 'paid' : ($order->payment_status == 'rejected' ? 'rejected' : 'pending') }}">
                                            {{ strtoupper(str_replace('_', ' ', $order->payment_status ?? 'pending')) }}
                                        </span>
                                    </div>

                                    <div style="margin-top:10px;">
                                        <a href="{{ $proofUrl }}" target="_blank" rel="noopener"
                                            class="btn-link">Lihat ukuran asli</a>
                                        <a href="{{ $proofUrl }}" download="{{ $filename }}"
                                            class="btn-link ml-3">Download</a>
                                    </div>
                                </div>
                            </div>

                            {{-- modal penuh dengan kontrol zoom --}}
                            <div id="proof-modal" class="modal" aria-hidden="true" onclick="closeProof()">
                                <div class="modal-inner" onclick="event.stopPropagation()">
                                    <div class="modal-header">
                                        <div class="modal-actions-left">
                                            <button class="modal-close" onclick="closeProof()" title="Tutup">✕</button>
                                        </div>
                                        <div class="modal-actions-right">
                                            <button type="button" id="zoom-in" class="small-btn"
                                                title="Zoom in">+</button>
                                            <button type="button" id="zoom-out" class="small-btn"
                                                title="Zoom out">−</button>
                                            <button type="button" id="zoom-reset" class="small-btn"
                                                title="Reset zoom">Reset</button>
                                            <a href="{{ $proofUrl }}" target="_blank" rel="noopener"
                                                class="small-btn link-btn" title="Buka asli di tab baru">Buka asli</a>
                                        </div>
                                    </div>

                                    <div class="modal-body">
                                        <img id="modal-img" src="{{ $proofUrl }}" alt="Bukti Pembayaran (besar)" />
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="muted">Belum ada bukti pembayaran yang diupload oleh buyer.</p>
                        @endif
                    </div>
                    {{-- ====== END BUKTI PEMBAYARAN ====== --}}

                </section>

                {{-- RIGHT: ringkasan + alamat + shipping --}}
                <aside class="card side-card">
                    <div class="section">
                        <h3 class="small-title">Ringkasan Pesanan</h3>

                        <div class="row-space">
                            <span>Subtotal</span>
                            <strong>Rp {{ number_format($order->subtotal ?? 0, 0, ',', '.') }}</strong>
                        </div>

                        <div class="row-space">
                            <span>Ongkos Kirim</span>
                            <strong>Rp {{ number_format($order->shipping_cost ?? 0, 0, ',', '.') }}</strong>
                        </div>

                        <hr class="sep">

                        <div class="row-space total">
                            <span>Total</span>
                            <strong>Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</strong>
                        </div>
                    </div>

                    <div class="section mt-4">
                        <h3 class="small-title">Alamat Pengiriman</h3>
                        <p class="muted">{{ $order->shipping_address ?? '-' }}</p>
                        <p class="muted">Penerima: {{ $order->receiver_name ?? '-' }}</p>
                        <p class="muted">No. HP: {{ $order->receiver_phone ?? ($order->user->phone ?? '-') }}</p>
                    </div>

                    <div class="section mt-4">
                        <h3 class="small-title">Metode Pengiriman</h3>
                        @php
                            $methodLabel = match ($order->shipping_method ?? 'reguler') {
                                'reguler' => 'Reguler (3–5 hari)',
                                'express' => 'Express (1–2 hari)',
                                'instant' => 'Instant (Tiba hari ini)',
                                default => ucfirst($order->shipping_method ?? '-'),
                            };
                        @endphp
                        <p><span class="badge ship">{{ $methodLabel }}</span></p>
                    </div>

                    <div class="section mt-4">
                        <h3 class="small-title">Informasi Lain</h3>
                        <p class="muted"><strong>Status Order:</strong>
                            <span class="badge process">{{ strtoupper($order->status ?? '-') }}</span>
                        </p>
                        <p class="muted"><strong>Dibuat:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>
                </aside>

            </div>
        </div>
    </main>

    {{-- Minimal styles (copy into your project CSS if you prefer) --}}
    <style>
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --muted: #6b7280;
            --accent: #16a34a;
            --green: #22c55e;
            --red: #dc2626;
            --blue: #2563eb;
        }

        .main {
            padding: 28px 28px 80px;
            background: var(--bg);
            min-height: 80vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* top row */
        .top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .title-block h1 {
            margin: 0;
            font-size: 22px;
            color: #0f172a;
        }

        .muted {
            color: var(--muted);
            margin: 4px 0;
            font-size: 13px;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 9px 14px;
            border-radius: 8px;
            color: #fff;
            font-weight: 700;
            border: none;
            cursor: pointer;
        }

        .btn.green {
            background: var(--green);
        }

        .btn.red {
            background: var(--red);
        }

        /* grid */
        .grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 20px;
            align-items: start;
        }

        @media (max-width:900px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .actions {
                width: 100%;
                justify-content: flex-start
            }
        }

        .card {
            background: var(--card);
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 8px 24px rgba(2, 6, 23, 0.06);
        }

        .main-card {
            min-height: 200px;
        }

        .side-card {
            position: sticky;
            top: 24px;
        }

        .section-header h2 {
            margin: 0 0 10px 0;
            font-size: 16px;
            color: #0f172a;
        }

        /* table */
        .table-wrap {
            overflow: auto;
            border-radius: 8px;
        }

        .item-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .item-table thead th {
            text-align: left;
            background: #f3f4f6;
            padding: 12px;
            font-weight: 700;
            color: #374151;
        }

        .item-table tbody td {
            padding: 12px;
            border-bottom: 1px solid #eef2f7;
            color: #1f2937;
        }

        .item-table .center {
            text-align: center;
        }

        .item-table .right {
            text-align: right;
        }

        .product-cell .product-name {
            font-weight: 700;
            color: #0f172a;
        }

        .product-sub {
            color: var(--muted);
            font-size: 12px;
        }

        .row-space {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 8px 0;
            color: #374151;
        }

        .sep {
            border: none;
            border-top: 1px solid #eef2f7;
            margin: 12px 0;
        }

        .total {
            font-size: 16px;
        }

        /* badges */
        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 12px;
        }

        .badge.paid {
            background: #dcfce7;
            color: #166534;
        }

        .badge.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge.rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge.process {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge.ship {
            background: #ecfccb;
            color: #365314;
        }

        /* proof */
        .proof-wrap {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 8px;
        }

        .proof-wrap img {
            width: 140px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(2, 6, 23, 0.06);
            border: 1px solid #eef2f7;
        }

        .proof-meta {
            font-size: 13px;
            color: var(--muted);
        }

        .btn-link {
            display: inline-block;
            padding: 6px 10px;
            background: #f8fafc;
            border: 1px solid #e6edf3;
            border-radius: 8px;
            color: #0f172a;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-link.ml-3 {
            margin-left: 12px;
        }

        /* modal */
        .modal {
            position: fixed;
            inset: 0;
            display: none;
            background: rgba(2, 6, 23, 0.6);
            align-items: center;
            justify-content: center;
            z-index: 60;
            padding: 18px;
        }

        .modal[aria-hidden="false"] {
            display: flex;
        }

        .modal-inner {
            background: #fff;
            padding: 12px;
            border-radius: 10px;
            max-width: 95%;
            max-height: 95%;
            overflow: auto;
            position: relative;
            width: 100%;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .modal-header .modal-actions-right {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .modal-inner img {
            max-width: 100%;
            max-height: 80vh;
            display: block;
            margin: 0 auto;
            border-radius: 8px;
            transition: transform 0.15s ease;
        }

        .modal-close {
            background: #f3f4f6;
            border: none;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
        }

        .small-btn {
            border: 1px solid #e6edf3;
            background: #fff;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
        }

        .link-btn {
            border: 1px solid #e6edf3;
            background: #f8fafc;
            padding: 8px 10px;
            border-radius: 8px;
            text-decoration: none;
            color: #0f172a;
            font-weight: 700;
        }

        @media (max-width:640px) {
            .proof-wrap img {
                width: 120px;
                height: 84px;
            }

            .modal-inner img {
                max-height: 70vh;
            }
        }

        .small-title {
            margin: 0 0 8px 0;
            font-size: 14px;
            color: #0f172a;
            font-weight: 700;
        }

        .mt-6 {
            margin-top: 24px;
        }

        .mt-4 {
            margin-top: 16px;
        }
    </style>

    {{-- JS untuk modal + zoom --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const thumbLink = document.getElementById('proof-open');
            const modal = document.getElementById('proof-modal');
            const modalImg = document.getElementById('modal-img');

            // safety checks
            if (!modal || !modalImg) return;

            if (thumbLink) {
                thumbLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    // reset scale
                    modalImg.style.transform = 'scale(1)';
                    modalImg.dataset.scale = 1;
                    modal.setAttribute('aria-hidden', 'false');
                });
            }

            window.closeProof = function() {
                if (modal) modal.setAttribute('aria-hidden', 'true');
            };

            // zoom controls
            const zoomIn = document.getElementById('zoom-in');
            const zoomOut = document.getElementById('zoom-out');
            const zoomReset = document.getElementById('zoom-reset');

            function setScale(scale) {
                modalImg.dataset.scale = scale;
                modalImg.style.transform = 'scale(' + scale + ')';
            }

            if (zoomIn) {
                zoomIn.addEventListener('click', function() {
                    let s = parseFloat(modalImg.dataset.scale || 1);
                    s = Math.min(s + 0.25, 4);
                    setScale(s);
                });
            }

            if (zoomOut) {
                zoomOut.addEventListener('click', function() {
                    let s = parseFloat(modalImg.dataset.scale || 1);
                    s = Math.max(s - 0.25, 0.25);
                    setScale(s);
                });
            }

            if (zoomReset) {
                zoomReset.addEventListener('click', function() {
                    setScale(1);
                });
            }

            // close on esc
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal) {
                    closeProof();
                }
            });

            // allow drag to pan when zoomed - simple implementation
            (function enablePanWhenZoomed() {
                let isDragging = false;
                let startX = 0,
                    startY = 0,
                    lastX = 0,
                    lastY = 0;

                modalImg.addEventListener('mousedown', function(e) {
                    const scale = parseFloat(modalImg.dataset.scale || 1);
                    if (scale <= 1) return;
                    isDragging = true;
                    startX = e.clientX - lastX;
                    startY = e.clientY - lastY;
                    modalImg.style.cursor = 'grabbing';
                    e.preventDefault();
                });

                document.addEventListener('mousemove', function(e) {
                    if (!isDragging) return;
                    lastX = e.clientX - startX;
                    lastY = e.clientY - startY;
                    modalImg.style.transform =
                        `scale(${modalImg.dataset.scale || 1}) translate(${lastX / (modalImg.dataset.scale || 1)}px, ${lastY / (modalImg.dataset.scale || 1)}px)`;
                });

                document.addEventListener('mouseup', function() {
                    if (!isDragging) return;
                    isDragging = false;
                    modalImg.style.cursor = 'default';
                });

                // reset translate when zoom reset
                const origSetScale = setScale;
                window.setScaleAndResetPan = function(s) {
                    lastX = 0;
                    lastY = 0;
                    modalImg.style.transform = `scale(${s})`;
                    modalImg.dataset.scale = s;
                };

                // override zoomReset to also reset pan
                if (zoomReset) {
                    zoomReset.addEventListener('click', function() {
                        window.setScaleAndResetPan(1);
                    });
                }
            })();

        });
    </script>

</x-layoutAdmin>
