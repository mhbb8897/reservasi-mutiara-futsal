<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
        <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <div class="mb-6 flex justify-end">
                <select wire:model.live="sort"
                    class="block w-44 px-3 py-2 text-base bg-gray-100 rounded-md shadow-sm cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                    <option value="latest">Sort by Latest</option>
                    <option value="price">Sort by Price</option>
                </select>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($lapangans as $lapangan)
                    <div
                        class="bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden dark:bg-gray-900 dark:border-gray-700">
                        @php
                            $images = is_array($lapangan->images)
                                ? $lapangan->images
                                : json_decode($lapangan->images, true);
                            $imagePath = $images[0] ?? null;
                            $imageUrl = $imagePath ? asset("storage/" . ltrim($imagePath, "/")) : asset("storage/image/lapangan-a.jpg");
                        @endphp
                        <img src="{{ $imageUrl }}" alt="{{ $lapangan->nama }}" class="object-cover w-full h-56">

                        <div class="p-4 flex flex-col justify-between h-[calc(100%-14rem)]">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                                {{ $lapangan->nama }}</h3>
                            <p class="text-blue-600 text-base mb-4 dark:text-blue-400">
                                Rp {{ number_format($lapangan->harga_per_jam, 0, ",", ".") }} / jam
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route("jadwal.page", $lapangan->id) }}"
                                    class="flex justify-center items-center gap-2 text-white bg-orange-600 hover:bg-orange-700 py-2 px-4 rounded shadow dark:bg-green-500 dark:hover:bg-green-600">
                                    Lihat Jadwal
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
