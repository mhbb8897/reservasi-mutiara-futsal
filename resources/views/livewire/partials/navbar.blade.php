<header
    class="flex z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-white text-sm py-3 md:py-0 dark:bg-gray-800 shadow-md">
    <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
        <div class="relative md:flex md:items-center md:justify-between">
            <div class="flex items-center justify-between">
                <a class="flex-none text-xl font-semibold dark:text-white dark:focus:outline-none  dark:focus:ring-gray-600"
                    href="/" aria-label="Brand">Mutiara Futsal</a>
                <div class="md:hidden">
                    <button type="button"
                    class="hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-white text-white hover:bg-white/10 dark:border-white dark:hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white"
                    data-hs-collapse="#navbar-collapse-with-animation"
                    aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">

                    <!-- Ikon buka -->
                    <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>

                    <!-- Ikon tutup -->
                    <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>

                </div>
            </div>

            <div id="navbar-collapse-with-animation"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
                <div
                    class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
                    <div
                        class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-gray-700">

                        <a class="font-medium {{ request()->is('/') ? 'text-orange-600' : 'text-gray-500' }} py-3 md:py-6 dark:text-orange-500   "
                            href="/" aria-current="page">Home</a>

                        <a class="font-medium {{ request()->is('lapangan') }} text-white hover:text-gray-500 py-3 md:py-6   "
                            href="/lapangan">
                            Pilih Lapangan
                        </a>
                        {{-- <a href="/booking"
                            class="font-medium flex items-center
          {{ request()->is('booking') ? 'text-orange-600' : 'text-gray-500' }}
          hover:text-gray-400 py-3 md:py-6
          dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none . dark:focus:ring-gray-600">

                            <!-- Ikon trolley -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.447M7.5 14.25h9.371a1.5
             1.5 0 0 0 1.458-1.179l1.347-6.053a.75.75 0 0 0-.733-.918H6.015M7.5
             14.25L5.106 5.283M7.5 14.25l-.347 1.387A1.5 1.5 0 0 0 8.621
             17.25h7.758a1.5 1.5 0 0 0 1.468-1.117L18.75 12M10.5
             20.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0
             1.5Zm6 0a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                            </svg>
                            <span class="mr-1">Booking</span>
                        </a> --}}
                        @guest
                            <div class="pt-3 md:pt-0">
                                <a class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-orange-600 text-white hover:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none"
                                    href="/login">
                                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    Log in
                                </a>
                            </div>
                        @endguest
                        @auth
                            <div class="hs-dropdown relative inline-flex py-2" data-hs-dropdown-trigger="click">
                                <button type="button"
                                    class="flex items-center text-sm font-medium text-white cursor-pointer hover:text-gray-500">

                                    <!-- Ikon user -->
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.121 17.804A11.963 11.963 0 0112 15c2.623 0 5.046.84 6.879 2.255M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                        </path>
                                    </svg>

                                    <!-- Nama pengguna -->
                                    <span>{{ auth()->user()->name }}</span>

                                    <!-- Ikon panah dropdown -->
                                    <svg class="ms-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </button>

                                <div class="hs-dropdown-menu hidden z-10 mt-2 w-48 bg-white shadow-md rounded-lg p-2"
                                    aria-labelledby="hs-dropdown-with-header">
                                    <a href="{{ route('riwayat.page') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                        History
                                    </a>
                                    <a href="{{ route('profil') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                        My Account
                                    </a>
                                    <a href="/logout" class="block px-4 py-2 text-sm hover:bg-gray-100">
                                        Logout
                                    </a>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
