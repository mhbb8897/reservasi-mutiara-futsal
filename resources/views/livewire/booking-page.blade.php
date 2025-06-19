<div class="max-w-xl mx-auto py-10 px-6 bg-white rounded shadow dark:bg-gray-900">
    <h2 class="text-2xl font-bold mb-4">Booking: {{ $lapangan->nama }}</h2>

    @if (session()->has('success'))
        <div class="mb-4 text-green-600 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <label class="block mb-1 font-medium">Tanggal Booking</label>
        <input type="date" wire:model.defer="tanggal_booking" class="w-full border rounded px-3 py-2">
        @error('tanggal_booking') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Waktu Mulai</label>
        <input type="time" wire:model.defer="waktu_mulai" class="w-full border rounded px-3 py-2">
        @error('waktu_mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Waktu Selesai</label>
        <input type="time" wire:model.defer="waktu_selesai" class="w-full border rounded px-3 py-2">
        @error('waktu_selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <button wire:click="simpan"
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold">
        Booking Sekarang
    </button>
</div>
