@extends('layouts.peserta')

@section('title', 'Daftar Program LPK')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Daftar Program LPK Jepang</h1>
        <p class="text-gray-600 mt-1">Bergabunglah dengan program pelatihan kerja ke Jepang</p>
    </div>

    <div class="max-w-4xl mx-auto">
        <!-- Info Program -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 mb-6 text-white">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-bold">Program LPK Jepang</h3>
                    <p class="text-green-100 mt-1">Pelatihan kerja 3 tahun di Jepang dengan berbagai bidang spesialisasi</p>
                </div>
            </div>
        </div>

        <!-- Keuntungan Program -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                        </path>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Gaji Kompetitif</h4>
                <p class="text-sm text-gray-600">Gaji sesuai standar minimum Jepang dengan tunjangan yang menarik</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Pelatihan Bahasa</h4>
                <p class="text-sm text-gray-600">Pelatihan bahasa Jepang intensif sebelum keberangkatan</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Legal & Aman</h4>
                <p class="text-sm text-gray-600">Program resmi dengan visa kerja yang legal dan terjamin</p>
            </div>
        </div>

        <!-- Form Pendaftaran -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Pendaftaran</h3>
                <p class="text-sm text-gray-600 mt-1">Pastikan data profil Anda sudah lengkap sebelum mendaftar</p>
            </div>
            <div class="p-6">
                <!-- Data Peserta -->
                <div class="mb-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-4">Data Anda</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                                <p class="text-sm text-gray-900">{{ auth()->user()->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-sm text-gray-900">{{ auth()->user()->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">No. Telepon</p>
                                <p class="text-sm text-gray-900">{{ auth()->user()->no_telepon ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal Lahir</p>
                                <p class="text-sm text-gray-900">
                                    {{ auth()->user()->tanggal_lahir ? auth()->user()->tanggal_lahir->format('d M Y') : '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pendidikan Terakhir</p>
                                <p class="text-sm text-gray-900">{{ auth()->user()->pendidikan_terakhir ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Alamat</p>
                                <p class="text-sm text-gray-900">{{ auth()->user()->alamat ?? '-' }}</p>
                            </div>
                        </div>

                        @if (
                            !auth()->user()->no_telepon ||
                                !auth()->user()->tanggal_lahir ||
                                !auth()->user()->pendidikan_terakhir ||
                                !auth()->user()->alamat)
                            <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="ml-3">
                                        <h4 class="text-sm font-medium text-yellow-800">Data Belum Lengkap</h4>
                                        <p class="mt-1 text-sm text-yellow-700">
                                            Silakan lengkapi data profil Anda terlebih dahulu sebelum mendaftar.
                                            <a href="{{ route('peserta.profil.edit') }}" class="font-medium underline">Edit
                                                Profil</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Syarat dan Ketentuan -->
                <div class="mb-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-4">Syarat dan Ketentuan</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Usia minimal 18 tahun dan maksimal 35 tahun
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Minimal pendidikan SMP sederajat
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Sehat jasmani dan rohani
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Tidak memiliki catatan kriminal
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Bersedia mengikuti pelatihan bahasa Jepang
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-green-500 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Melengkapi semua dokumen yang diperlukan
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Form Konfirmasi -->
                <form method="POST" action="{{ route('peserta.pendaftaran.store') }}">
                    @csrf
                    <div class="mb-6">
                        <div class="flex items-center">
                            <input id="agree" name="agree" type="checkbox" required
                                class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="agree" class="ml-2 block text-sm text-gray-900">
                                Saya menyetujui <a href="#"
                                    class="text-green-600 hover:text-green-500 font-medium">syarat dan ketentuan</a>
                                yang berlaku dan bersedia mengikuti seluruh proses program LPK Jepang.
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('peserta.dashboard') }}"
                            class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                            Kembali
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 
                                   {{ !auth()->user()->no_telepon || !auth()->user()->tanggal_lahir || !auth()->user()->pendidikan_terakhir || !auth()->user()->alamat ? 'opacity-50 cursor-not-allowed' : '' }}"
                            {{ !auth()->user()->no_telepon || !auth()->user()->tanggal_lahir || !auth()->user()->pendidikan_terakhir || !auth()->user()->alamat ? 'disabled' : '' }}>
                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Daftar Program
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
