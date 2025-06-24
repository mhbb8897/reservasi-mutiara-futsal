<div class="max-w-6xl mx-auto py-10 px-4">
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
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow">
                            Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Table -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-3">Jadwal Booking ({{ $tanggal }})</h3>
            <table class="min-w-full border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2 text-left">Penyewa</th>
                        <th class="border px-3 py-2 text-left">Waktu Mulai</th>
                        <th class="border px-3 py-2 text-left">Waktu Selesai</th>
                        <th class="border px-3 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td class="border px-3 py-2">{{ $booking->user->name ?? '-' }}</td>
                            <td class="border px-3 py-2">
                                {{ \Carbon\Carbon::parse($booking->waktu_mulai)->format('H:i') }}</td>
                            <td class="border px-3 py-2">
                                {{ \Carbon\Carbon::parse($booking->waktu_selesai)->format('H:i') }}</td>
                            <td class="border px-3 py-2 capitalize">{{ $booking->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3 text-gray-500">Belum ada booking</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Button Booking -->
        <div class="mt-6 flex justify-end">
            <a href="{{ route('booking.page', $lapangan->id) }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                Booking Sekarang
            </a>
        </div>
    </div>
</div>
