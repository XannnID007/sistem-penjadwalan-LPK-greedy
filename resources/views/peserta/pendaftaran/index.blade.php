@extends('layouts.peserta')

@section('title', 'Status Pendaftaran')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Status Pendaftaran</h1>
        <p class="text-gray-600 mt-1">Lihat status pendaftaran Anda</p>
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

    @if (session('info'))
        <div class="mb-6 bg-blue-50 border border-blue-300 rounded-md p-4">
            <div class="flex">
                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">{{ session('info') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            @if ($pendaftaran)
                <!-- Jika sudah ada pendaftaran, tampilkan ringkasan -->
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Pendaftaran Berhasil!</h3>
                    <p class="text-gray-600 mb-4">Nomor pendaftaran Anda: <span
                            class="font-semibold text-green-600">{{ $pendaftaran->nomor_pendaftaran }}</span></p>

                    <div class="flex justify-center space-x-3">
                        <a href="{{ route('peserta.pendaftaran.show') }}"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                            Lihat Detail & Upload Dokumen
                        </a>
                        <a href="{{ route('peserta.dashboard') }}"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>

                <!-- Status ringkas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <p class="text-sm font-medium text-gray-500">Status</p>
                        <span
                            class="inline-flex px-2 py-1 text-xs font-semibold rounded-full mt-1
                        @if ($pendaftaran->status == 'menunggu') bg-yellow-100 text-yellow-800
                        @elseif($pendaftaran->status == 'terverifikasi') bg-green-100 text-green-800
                        @elseif($pendaftaran->status == 'ditolak') bg-red-100 text-red-800
                        @else bg-purple-100 text-purple-800 @endif">
                            {{ ucfirst($pendaftaran->status) }}
                        </span>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <p class="text-sm font-medium text-gray-500">Dokumen</p>
                        <p class="text-lg font-semibold text-gray-900 mt-1">{{ $pendaftaran->dokumen->count() }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <p class="text-sm font-medium text-gray-500">Tanggal Daftar</p>
                        <p class="text-sm text-gray-900 mt-1">{{ $pendaftaran->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            @else
                <!-- Jika belum ada pendaftaran -->
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
@endsection
