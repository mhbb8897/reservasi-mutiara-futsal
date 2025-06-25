<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded shadow z-50">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="text-4xl font-bold text-white">Riwayat Penyewaan</h1>
    <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">ID
                                    Booking</th>
                                <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal
                                </th>
                                <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status
                                </th>
                                <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    Lapangan
                                </th>
                                <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Total
                                </th>
                                <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    // Badge status
                                    $status = match ($order->status) {
                                        'pending'
                                            => '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Menunggu</span>',
                                        'confirmed'
                                            => '<span class="bg-green-600 py-1 px-3 rounded text-white shadow">Dikonfirmasi</span>',
                                        'cancelled'
                                            => '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Dibatalkan</span>',
                                    };

                                    // Hitung total (fallback ke perhitungan manual jika belum ada pembayaran)
                                    $total =
                                        $order->pembayaran?->total ??
                                        ($order->lapangan->harga_per_jam *
                                            (strtotime($order->waktu_selesai) - strtotime($order->waktu_mulai))) /
                                            3600;
                                @endphp

                                <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800"
                                    wire:key="{{ $order->id }}">
                                    <!-- ID Booking -->
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $order->id }}
                                    </td>

                                    <!-- Tanggal -->
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                        {{ \Carbon\Carbon::parse($order->tanggal_booking)->format('d M Y') }}
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                        {!! $status !!}</td>

                                    <!-- Lapangan -->
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                        {{ $order->lapangan->nama ?? '-' }}
                                    </td>

                                    <!-- Total -->
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-6 py-4 text-end text-sm font-medium " x-data="{ showDetail: false, showCancelConfirm: false }">
                                        @if ($order->status === 'pending')
                                            <!-- Tombol Batalkan -->
                                            <button @click="showCancelConfirm = true"
                                                class="ml-2 bg-red-600 text-white cursor-pointer py-2 px-4 rounded-md hover:bg-red-500">
                                                Batalkan
                                            </button>

                                            <!-- Modal Konfirmasi Pembatalan -->
                                            <!-- Modal Konfirmasi Pembatalan -->
                                            <div x-show="showCancelConfirm"
                                                class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center"
                                                x-cloak>

                                                <div class="bg-white p-6 rounded shadow w-full max-w-md text-center">
                                                    <h2 class="text-lg font-bold mb-3">Konfirmasi Pembatalan</h2>
                                                    <p>Apakah kamu yakin ingin membatalkan booking
                                                        <strong>#{{ $order->id }}</strong>?
                                                    </p>

                                                    <div class="mt-4 flex justify-center gap-2">
                                                        <!-- Tombol YA -->
                                                        <button type="button"
                                                            @click="
                                                            showCancelConfirm = false;
                                                            $dispatch('close-modal');
                                                            @this.call('cancelOrder', {{ $order->id }});
                                                        "
                                                            class="px-4 py-2 bg-red-600 cursor-pointer text-white rounded hover:bg-red-500">
                                                            Ya, Batalkan
                                                        </button>

                                                        <!-- Tombol Batal -->
                                                        <button type="button" @click="showCancelConfirm = false"
                                                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                                                            Batal
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Tombol Detail -->
                                        <button @click="showDetail = true"
                                            class="bg-slate-600 text-white py-2 cursor-pointer px-4 rounded-md hover:bg-slate-500">
                                            Detail
                                        </button>

                                        <!-- Modal Detail -->
                                        <div x-show="showDetail"
                                            class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center"
                                            x-cloak>
                                            <div class="bg-white p-6 text-center rounded shadow w-full max-w-sm">
                                                <h2 class="text-lg font-bold mb-3">Detail Booking #{{ $order->id }}
                                                </h2>
                                                <ul class="text-sm space-y-2">
                                                    <li><strong>Tanggal:</strong>
                                                        {{ \Carbon\Carbon::parse($order->tanggal_booking)->format('d M Y') }}
                                                    </li>
                                                    <li><strong>Jam:</strong> {{ $order->waktu_mulai }} -
                                                        {{ $order->waktu_selesai }}</li>
                                                    <li><strong>Status:</strong> {!! $status !!}</li>
                                                    <li><strong>Lapangan:</strong> {{ $order->lapangan->nama ?? '-' }}
                                                    </li>
                                                    <li><strong>Total:</strong> Rp
                                                        {{ number_format($total, 0, ',', '.') }}</li>
                                                </ul>
                                                <div class="mt-4 text-center">
                                                    <button @click="showDetail = false"
                                                        class="px-4 cursor-pointer py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@vite('resources/js/app.js')
