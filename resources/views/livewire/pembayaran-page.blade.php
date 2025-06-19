<div class="max-w-xl mx-auto py-10 px-6 bg-white rounded shadow dark:bg-gray-900">
    <h2 class="text-2xl font-bold mb-4">Pembayaran Booking</h2>

    @if (session()->has('success'))
        <div class="mb-4 text-green-600 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <p class="mb-4">Lapangan: <strong>{{ $booking->lapangan->nama }}</strong></p>
    <p class="mb-4">Tanggal: <strong>{{ $booking->tanggal_booking }}</strong></p>
    <p class="mb-4">Waktu: <strong>{{ $booking->waktu_mulai }} - {{ $booking->waktu_selesai }}</strong></p>
    <p class="mb-6 text-lg font-semibold">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Metode Pembayaran</label>
        <select wire:model.defer="metode_pembayaran" class="w-full border rounded px-3 py-2">
            <option value="">-- Pilih --</option>
            <option value="qris">QRIS</option>
            <option value="transfer">Transfer Bank</option>
            <option value="cash">Bayar di Tempat (Cash)</option>
        </select>
        @error('metode_pembayaran') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4" x-data>
        <label class="block mb-1 font-medium">Upload Bukti Pembayaran (Opsional)</label>
        <input type="file" wire:model="bukti_pembayaran" class="w-full border rounded px-3 py-2">
        @error('bukti_pembayaran') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <div wire:loading wire:target="bukti_pembayaran" class="text-sm text-gray-500 mt-2">Mengunggah...</div>
        @if ($bukti_pembayaran)
            <img src="{{ $bukti_pembayaran->temporaryUrl() }}" class="mt-4 rounded w-48">
        @endif
    </div>

    <button wire:click="simpan"
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold">
        Kirim Pembayaran
    </button>
</div>
