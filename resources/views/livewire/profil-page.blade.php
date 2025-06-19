<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10 mb-10">
    <div class="flex items-center mb-4">
        <div class="bg-blue-100 text-blue-700 p-2 rounded-full mr-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <h2 class="text-xl font-semibold text-gray-700">Profil Saya</h2>
    </div>

    <div class="space-y-4">
        <div><strong>Nama:</strong> {{ $name }}</div>
        <div><strong>Email:</strong> {{ $email }}</div>
    </div>

    <div class="mt-6">
        <a href="{{ route('edit-profil') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Edit Profil</a>
    </div>
</div>
