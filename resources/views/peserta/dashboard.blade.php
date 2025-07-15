@extends('layouts.peserta')

@section('title', 'Dashboard Peserta')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard Peserta</h1>
        <p class="text-gray-600 mt-1">Selamat datang, {{ auth()->user()->nama }}!</p>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-300 rounded-md p-4">
            <div class="flex">
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Status Pendaftaran -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Status Pendaftaran</h3>
                </div>
                <div class="p-6">
                    @if ($pendaftaran)
                        <div class="space-y-4">
                            <!-- Info Pendaftaran -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Nomor Pendaftaran</p>
                                    <p class="text-lg font-bold text-green-600">{{ $pendaftaran->nomor_pendaftaran }}</p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="px-3 py-1 text-sm font-medium rounded-full
                                    @if ($pendaftaran->status == 'menunggu') bg-yellow-100 text-yellow-800
                                    @elseif($pendaftaran->status == 'terverifikasi') bg-green-100 text-green-800
                                    @elseif($pendaftaran->status == 'ditolak') bg-red-100 text-red-800
                                    @else bg-purple-100 text-purple-800 @endif">
                                        {{ ucfirst($pendaftaran->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Progress Steps -->
                            <div class="mt-6">
                                <div class="flex items-center">
                                    <!-- Step 1: Pendaftaran -->
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Pendaftaran</p>
                                            <p class="text-xs text-gray-500">Selesai</p>
                                        </div>
                                    </div>

                                    <!-- Connector -->
                                    <div class="flex-1 h-0.5 bg-gray-200 mx-4">
                                        <div class="h-full bg-green-500"
                                            style="width: {{ $pendaftaran->status != 'menunggu' ? '100%' : '0%' }}"></div>
                                    </div>

                                    <!-- Step 2: Verifikasi -->
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 {{ in_array($pendaftaran->status, ['terverifikasi', 'terjadwal']) ? 'bg-green-500' : ($pendaftaran->status == 'ditolak' ? 'bg-red-500' : 'bg-gray-300') }} rounded-full flex items-center justify-center">
                                            @if (in_array($pendaftaran->status, ['terverifikasi', 'terjadwal']))
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif($pendaftaran->status == 'ditolak')
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <span class="text-xs text-gray-600">2</span>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Verifikasi</p>
                                            <p class="text-xs text-gray-500">
                                                @if ($pendaftaran->status == 'menunggu')
                                                    Menunggu
                                                @elseif($pendaftaran->status == 'terverifikasi')
                                                    Selesai
                                                @elseif($pendaftaran->status == 'ditolak')
                                                    Ditolak
                                                @else
                                                    Selesai
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Connector -->
                                    <div class="flex-1 h-0.5 bg-gray-200 mx-4">
                                        <div class="h-full bg-green-500"
                                            style="width: {{ $pendaftaran->status == 'terjadwal' ? '100%' : '0%' }}"></div>
                                    </div>

                                    <!-- Step 3: Penjadwalan -->
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 {{ $pendaftaran->status == 'terjadwal' ? 'bg-green-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center">
                                            @if ($pendaftaran->status == 'terjadwal')
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <span class="text-xs text-gray-600">3</span>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Penjadwalan</p>
                                            <p class="text-xs text-gray-500">
                                                {{ $pendaftaran->status == 'terjadwal' ? 'Selesai' : 'Menunggu' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($pendaftaran->catatan)
                                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                    <h4 class="text-sm font-medium text-blue-900">Catatan dari Admin:</h4>
                                    <p class="mt-1 text-sm text-blue-700">{{ $pendaftaran->catatan }}</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Mendaftar</h3>
                            <p class="text-gray-600 mb-4">Anda belum mendaftar program LPK Jepang.</p>
                            <a href="{{ route('peserta.pendaftaran.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Daftar Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- Jadwal Keberangkatan -->
            @if ($jadwal)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Jadwal Keberangkatan</h3>
                    </div>
                    <div class="p-6">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900">{{ $jadwal->nama_batch }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $jadwal->tanggal_keberangkatan->format('d M Y') }}
                            </p>

                            <div class="mt-4 p-3 bg-green-50 rounded-lg">
                                <p class="text-sm text-green-800">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Anda telah terjadwal!
                                </p>
                            </div>

                            @if ($jadwal->keterangan)
                                <div class="mt-4 text-left">
                                    <p class="text-xs font-medium text-gray-700">Keterangan:</p>
                                    <p class="text-sm text-gray-600 mt-1">{{ $jadwal->keterangan }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="space-y-6">
                <!-- Panduan Dokumen (jika belum mendaftar atau status menunggu) -->
                @if (!$pendaftaran || $pendaftaran->status == 'menunggu')
                    <div class="bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Persiapkan Dokumen Anda</h3>
                                    <p class="text-sm text-blue-800 mb-4">
                                        Pelajari persyaratan dokumen yang diperlukan untuk mempercepat proses verifikasi
                                        pendaftaran Anda.
                                    </p>
                                    <div class="flex space-x-3">
                                        <a href="{{ route('peserta.panduan.dokumen') }}"
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                </path>
                                            </svg>
                                            Lihat Panduan Dokumen
                                        </a>
                                        @if ($pendaftaran)
                                            <a href="{{ route('peserta.pendaftaran.show') }}"
                                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                    </path>
                                                </svg>
                                                Upload Dokumen
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Tips -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Tips & Informasi</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @if (!$pendaftaran)
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="ml-2 text-sm text-gray-600">Pastikan data profil sudah lengkap sebelum
                                        mendaftar</p>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="ml-2 text-sm text-gray-600">Pelajari persyaratan dokumen di menu "Panduan
                                        Dokumen"</p>
                                </div>
                            @else
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="ml-2 text-sm text-gray-600">Lengkapi semua dokumen yang diperlukan</p>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="ml-2 text-sm text-gray-600">Pastikan data profil sudah akurat</p>
                                </div>
                            @endif
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <p class="ml-2 text-sm text-gray-600">Periksa status pendaftaran secara berkala</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <p class="ml-2 text-sm text-gray-600">Siapkan diri untuk pelatihan bahasa Jepang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
