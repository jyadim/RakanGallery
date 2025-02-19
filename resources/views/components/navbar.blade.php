<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">KennGallery</span>

        <!-- Mobile Toggle Button -->
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <!-- Navigation Links -->
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-4 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                @if (auth()->user()->is_admin)
                    <!-- Admin Menu -->
                    <li>
                        <x-navlink href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                            Admin Dashboard
                        </x-navlink>
                    </li>
                    <li>
                        <x-navlink href="{{ route('admin.profile') }}" :active="request()->routeIs('admin.profile')">
                            Profile
                        </x-navlink>
                    </li>
                    <li>
                        <a href="{{ route('admin.downloadReport') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Download Laporan PDF
                        </a>

                    </li>
                @else
                    <!-- User Menu -->
                    <li>
                        <x-navlink href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">Home</x-navlink>
                    </li>
                    <li>
                        <x-navlink href="{{ route('profile') }}" :active="request()->routeIs('profile')">Profile</x-navlink>
                    </li>
                    <li class="relative">
                        <a href="{{ route('notifications') }}"
                            class="block py-2 px-3 text-gray-900 rounded relative hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9" />
                                <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                            </svg>
                            <span
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-semibold px-1.5 py-0.5 rounded-full"
                                id="notif-count">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Navlink Component -->
