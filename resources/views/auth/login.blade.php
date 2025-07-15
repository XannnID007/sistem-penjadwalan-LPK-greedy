<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LPK Jepang</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

<body class="bg-gradient-to-br from-green-50 to-green-100 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <!-- Logo Badge -->
                <div class="mx-auto mb-4">
                    <svg width="100" height="100" viewBox="0 0 200 200" class="mx-auto">
                        <defs>
                            <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#22c55e;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#16a34a;stop-opacity:1" />
                            </linearGradient>
                            <linearGradient id="redGradient" x1="0%" y1="0%" x2="100%"
                                y2="100%">
                                <stop offset="0%" style="stop-color:#dc2626;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#991b1b;stop-opacity:1" />
                            </linearGradient>
                        </defs>

                        <!-- Badge Background -->
                        <path
                            d="M100 20 L140 50 L170 40 L180 80 L170 120 L140 150 L100 180 L60 150 L30 120 L20 80 L30 40 L60 50 Z"
                            fill="url(#gradient1)" stroke="#fff" stroke-width="3" />

                        <!-- Inner Circle -->
                        <circle cx="100" cy="100" r="55" fill="white" opacity="0.95" />

                        <!-- Japanese Elements -->
                        <circle cx="100" cy="85" r="15" fill="url(#redGradient)" />

                        <!-- Mountain (Fuji) -->
                        <path d="M70 115 L100 95 L130 115 Z" fill="#16a34a" />
                        <path d="M85 115 L100 103 L115 115 Z" fill="#22c55e" />

                        <!-- Text -->
                        <text x="100" y="135" text-anchor="middle" fill="#16a34a" font-family="Arial, sans-serif"
                            font-size="16" font-weight="bold">LPK</text>
                        <text x="100" y="150" text-anchor="middle" fill="#16a34a" font-family="Arial, sans-serif"
                            font-size="12">JEPANG</text>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900">Masuk ke Akun</h2>
            </div>

            <!-- Login Card -->
            <div class="bg-white shadow-lg rounded-lg p-8">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-300 rounded-md p-4">
                            <div class="flex">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan!</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="Masukkan email Anda" value="{{ old('email') }}">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="Masukkan password Anda">
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-900">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                            Masuk
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="font-medium text-green-600 hover:text-green-500">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
