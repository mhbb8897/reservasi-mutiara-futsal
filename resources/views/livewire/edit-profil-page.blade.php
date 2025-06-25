<div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
    <form wire:submit.prevent="update" class="space-y-4">
        <div class="grid grid-cols-1 gap-2">
            <label class="text-gray-700 font-semibold">Nama</label>
            <input type="text" wire:model.defer="name"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
            @error('name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid grid-cols-1 gap-2">
            <label class="text-gray-700 font-semibold">Email</label>
            <input type="email" wire:model.defer="email"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
            @error('email')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('profil') }}" class="text-gray-600 hover:text-blue-600">← Kembali</a>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Simpan Perubahan
            </button>
        </div>
    </form>
    {{-- FORM DI SINI --}}
</div>
