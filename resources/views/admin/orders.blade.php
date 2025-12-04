<x-layoutAdmin title="Daftar Pesanan">

    <main class="main">
        <div class="orders-wrapper">

            <div class="orders-header">
                <div>
                    <h1>Daftar Pesanan</h1>
                    <p>Kelola pesanan yang masuk dari para buyer.</p>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @if ($orders->isEmpty())
                <p class="empty-text">Belum ada pesanan yang masuk.</p>
            @else
                <div class="table-wrapper">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Kode Pesanan</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status Pembayaran</th>
                                <th>Status Order</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    $payClass = match ($order->payment_status) {
                                        'paid' => 'badge-paid',
                                        'rejected' => 'badge-rejected',
                                        'waiting_verification' => 'badge-waiting',
                                        default => 'badge-waiting',
                                    };

                                    $statusClass = match ($order->status) {
                                        'completed' => 'badge-done',
                                        'shipped' => 'badge-shipped',
                                        'paid' => 'badge-paid',
                                        'cancelled' => 'badge-rejected',
                                        default => 'badge-default',
                                    };
                                @endphp
                                <tr>
                                    <td>
                                        <span class="order-code">{{ $order->order_code }}</span>
                                        <div class="order-name">{{ $order->receiver_name }}</div>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $payClass }}">
                                            {{ strtoupper(str_replace('_', ' ', $order->payment_status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $statusClass }}">
                                            {{ strtoupper($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-detail">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </main>

    <style>
        .orders-wrapper {
            padding: 20px 24px 40px;
        }

        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .orders-header h1 {
            margin: 0;
            font-size: 22px;
        }

        .orders-header p {
            margin: 4px 0 0;
            color: #6b7280;
            font-size: 13px;
        }

        .alert {
            padding: 8px 12px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #b91c1c;
        }

        .empty-text {
            margin-top: 40px;
            text-align: center;
            color: #6b7280;
        }

        .table-wrapper {
            margin-top: 10px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .orders-table thead {
            background: #f3f4f6;
        }

        .orders-table th,
        .orders-table td {
            padding: 10px 14px;
            text-align: left;
        }

        .orders-table th {
            font-weight: 600;
            font-size: 13px;
            color: #4b5563;
            border-bottom: 1px solid #e5e7eb;
        }

        .orders-table tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        .orders-table tbody tr:hover {
            background: #eef2ff;
        }

        .order-code {
            font-weight: 600;
            display: block;
        }

        .order-name {
            font-size: 12px;
            color: #6b7280;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .03em;
        }

        .badge-paid {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #b91c1c;
        }

        .badge-waiting {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-default {
            background: #e5e7eb;
            color: #374151;
        }

        .badge-done {
            background: #d1fae5;
            color: #047857;
        }

        .badge-shipped {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .btn-detail {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 6px;
            background: #22c55e;
            color: #fff;
            font-size: 12px;
            text-decoration: none;
        }

        .btn-detail:hover {
            background: #16a34a;
        }
    </style>

</x-layoutAdmin>
