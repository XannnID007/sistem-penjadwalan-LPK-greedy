{{-- resources/views/layouts/peserta.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Peserta') - LPK Jepang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'green': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50" x-data="{ sidebarOpen: false }">
    <!-- Navbar -->
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 shadow-sm">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = !sidebarOpen" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <!-- Brand -->
                    <a href="{{ route('peserta.dashboard') }}" class="flex ml-2 md:mr-24">
                        <div class="h-8 w-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-gray-900">LPK
                            Jepang</span>
                    </a>
                </div>

                <!-- User dropdown -->
                <div class="flex items-center" x-data="{ dropdownOpen: false }">
                    <div class="flex items-center ml-3">
                        <div class="relative">
                            <button @click="dropdownOpen = !dropdownOpen" type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300">
                                <span class="sr-only">Open user menu</span>
                                @if (auth()->user()->foto_profil)
                                    <img class="w-8 h-8 rounded-full object-cover"
                                        src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="Foto profil">
                                @else
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <span
                                            class="text-white text-sm font-medium">{{ substr(auth()->user()->nama, 0, 1) }}</span>
                                    </div>
                                @endif
                            </button>

                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-50 mt-2 w-48 bg-white divide-y divide-gray-100 rounded shadow">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm text-gray-900" role="none">{{ auth()->user()->nama }}</p>
                                    <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                        {{ auth()->user()->email }}</p>
                                </div>
                                <ul class="py-1" role="none">
                                    <li>
                                        <a href="{{ route('peserta.profil.edit') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Edit Profil
                                        </a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                Keluar
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('peserta.dashboard') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-green-50 hover:text-green-700 group {{ request()->routeIs('peserta.dashboard') ? 'bg-green-100 text-green-700' : '' }}">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-green-700 {{ request()->routeIs('peserta.dashboard') ? 'text-green-700' : 'text-gray-500' }}"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('peserta.pendaftaran.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-green-50 hover:text-green-700 group {{ request()->routeIs('peserta.pendaftaran.*') ? 'bg-green-100 text-green-700' : '' }}">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-green-700 {{ request()->routeIs('peserta.pendaftaran.*') ? 'text-green-700' : 'text-gray-500' }}"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3">Pendaftaran Saya</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('peserta.jadwal') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-green-50 hover:text-green-700 group {{ request()->routeIs('peserta.jadwal') ? 'bg-green-100 text-green-700' : '' }}">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-green-700 {{ request()->routeIs('peserta.jadwal') ? 'text-green-700' : 'text-gray-500' }}"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3">Jadwal Keberangkatan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('peserta.profil.edit') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-green-50 hover:text-green-700 group {{ request()->routeIs('peserta.profil.*') ? 'bg-green-100 text-green-700' : '' }}">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-green-700 {{ request()->routeIs('peserta.profil.*') ? 'text-green-700' : 'text-gray-500' }}"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-3">Profil Saya</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main content -->
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            @yield('content')
        </div>
    </div>

    <!-- Mobile sidebar overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        class="fixed inset-0 z-30 bg-gray-900 bg-opacity-50 sm:hidden"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
</body>

</html>
