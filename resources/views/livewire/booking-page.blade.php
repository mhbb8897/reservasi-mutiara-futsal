<div class="max-w-xl mx-auto py-10 px-6 bg-white rounded shadow dark:bg-gray-900 text-white">
    <h2 class="text-2xl font-bold mb-4">Booking: {{ $lapangan->nama }}</h2>

    {{-- Flash Success --}}
    @if (session()->has('success'))
        <div class="mb-4 text-green-500 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tanggal Booking --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Tanggal Booking</label>
        <input type="date" wire:model.defer="tanggal_booking"
            class="w-full border rounded px-3 py-2 text-black">
        @error('tanggal_booking')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    {{-- Jam Main --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Jam Main</label>
        <select wire:model.defer="jam_main" class="w-full border rounded px-3 py-2 text-black">
            <option value="">-- Pilih Jam --</option>
            @for ($i = 9; $i <= 23; $i++)
                <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }} - {{ sprintf('%02d:00', $i+1) }}</option>
            @endfor
        </select>
        @error('jam_main')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    {{-- Jenis Pembayaran --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Pembayaran</label>
        <select wire:model.defer="jenis_pembayaran" class="w-full border rounded px-3 py-2 text-black">
            <option value="">-- Pilih Jenis Pembayaran --</option>
            <option value="dp">DP Rp10.000</option>
            <option value="setengah">50% (Rp75.000)</option>
            <option value="penuh">100% (Rp150.000)</option>
        </select>
        @error('jenis_pembayaran')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    {{-- Menampilkan Nominal --}}
    @if ($jenis_pembayaran)
        <div class="mb-4 text-sm text-yellow-300">
            Nominal yang harus dibayar:
            @if ($jenis_pembayaran === 'dp')
                <strong>Rp10.000</strong>
            @elseif ($jenis_pembayaran === 'setengah')
                <strong>Rp75.000</strong>
            @elseif ($jenis_pembayaran === 'penuh')
                <strong>Rp150.000</strong>
            @endif
        </div>
    @endif

    {{-- Tombol --}}
    <button wire:click="simpan"
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold w-full">
        Booking Sekarang
    </button>
</div>
