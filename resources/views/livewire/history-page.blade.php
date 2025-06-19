<div>
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded shadow z-50">
            {{ session('success') }}
        </div>
    @endif

    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <h1 class="text-4xl font-bold text-slate-500">Riwayat Penyewaan</h1>
        <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">ID Booking</th>
                                    <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    {{-- <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Waktu Mulai</th> --}}
                                    <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Total</th>
                                    <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @php
                                        $status = match ($order->status) {
                                            'pending' => '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Pending</span>',
                                            'confirmed' => '<span class="bg-green-600 py-1 px-3 rounded text-white shadow">Confirmed</span>',
                                            'cancelled' => '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Cancelled</span>',
                                        };

                                        $total = $order->pembayaran?->total ?? ($order->lapangan->harga_per_jam * (strtotime($order->waktu_selesai) - strtotime($order->waktu_mulai)) / 3600);
                                    @endphp
                                    <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800" wire:key='{{ $order->id }}'>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $order->id }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                            {{ \Carbon\Carbon::parse($order->tanggal_booking)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                            {!! $status !!}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                            Rp {{ number_format($total, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-end text-sm font-medium">
                                            @if ($order->status == 'pending')
                                                <button wire:click="cancelOrder({{ $order->id }})"
                                                    class="ml-2 bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-500">Batalkan</button>
                                            @endif
                                            <a href="/detail/{{ $order->id }}"
                                                class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">Detail</a>
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
</div>
