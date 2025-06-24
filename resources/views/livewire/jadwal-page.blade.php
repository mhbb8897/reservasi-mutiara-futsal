<div class="max-w-6xl mx-auto py-10 px-4 " >
    <div class="bg-white rounded-lg shadow p-6">
        <!-- Header -->
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                @php
                    $images = json_decode($lapangan->images, true);
                    $imageUrl = $images[0];
                @endphp
                <img src="{{ asset('storage/' . $imageUrl) }}" class="w-full h-64 object-cover rounded-lg shadow"
                    alt="Lapangan">
            </div>
            <div>
                <h2 class="text-2xl font-bold mb-2">{{ $lapangan->nama }}</h2>
                <p class="text-gray-700 mb-4">{{ $lapangan->deskripsi }}</p>
                <p class="text-green-600 font-semibold text-lg mb-2">Rp
                    {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / jam</p>
                <p class="text-sm text-gray-500 mb-2">Jam Operasional: 09.00 - 23.00 WIB</p>

                <div class="mt-6 flex items-center gap-4">
                    <div>
                        <label for="tanggal" class="block font-semibold mb-1">Pilih Tanggal:</label>
                        <input type="date" wire:model.defer="tanggal" id="tanggal"
                            class="border rounded px-3 py-2" />
                    </div>

                    <div class="pt-6">
                        <button wire:click="loadBookings"
                            class="bg-blue-600 hover:bg-blue-700 hover:cursor-pointer text-white font-semibold px-4 py-2 rounded shadow">
                            Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Table -->
        <div class="mt-10">
            <h3 class="text-xl font-bold mb-5 text-gray-800">
                Jadwal Booking ({{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }})
            </h3>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-x-auto transition duration-300">
                <table class="min-w-full text-sm border border-gray-200 dark:border-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                        <tr>
                            <th class="border px-4 py-3 text-left">Penyewa</th>
                            <th class="border px-4 py-3 text-left">Waktu Mulai</th>
                            <th class="border px-4 py-3 text-left">Waktu Selesai</th>
                            <th class="border px-4 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 text-white">
                                <td class="border px-4 py-2">{{ $booking->user->name ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($booking->waktu_mulai)->format('H:i') }}</td>
                                <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($booking->waktu_selesai)->format('H:i') }}</td>
                                <td class="border px-4 py-2 capitalize">{{ $booking->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-10 h-10 mb-2 text-gray-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                                        </svg>
                                        <span class="text-sm font-medium">
                                            Belum ada booking di tanggal {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}.
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tombol Booking -->
            <div class="mt-6 flex justify-end">
                <a href="{{ route('booking.page', $lapangan->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 transition text-white font-semibold px-6 py-2 rounded shadow">
                    Booking Sekarang
                </a>
            </div>
        </div>

    </div>
