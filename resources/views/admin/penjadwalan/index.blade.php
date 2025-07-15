@extends('layouts.admin')

@section('title', 'Penjadwalan Otomatis')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Penjadwalan Otomatis</h1>
                <p class="text-gray-600 mt-1">Sistem penjadwalan menggunakan algoritma greedy berdasarkan prioritas</p>
            </div>
            <div class="flex space-x-3">
                <button onclick="refreshSimulation()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    Refresh Simulasi
                </button>
                <form method="POST" action="{{ route('admin.penjadwalan.execute') }}" class="inline">
                    @csrf
                    <button type="submit"
                        onclick="return confirm('Apakah Anda yakin ingin melakukan penjadwalan? Proses ini tidak dapat dibatalkan.')"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Jalankan Penjadwalan
                    </button>
                </form>
            </div>
        </div>
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
                    <h3 class="text-sm font-medium text-green-800">Berhasil!</h3>
                    <p class="mt-1 text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-50 border border-red-300 rounded-md p-4">
            <div class="flex">
                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Error!</h3>
                    <p class="mt-1 text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Kriteria Algoritma Greedy -->
    <div class="mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Kriteria Algoritma Greedy</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-900">Tanggal Pendaftaran</h4>
                        <p class="text-sm text-gray-600 mt-1">Bobot: 40%</p>
                        <p class="text-xs text-gray-500 mt-1">First come, first served</p>
                    </div>

                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-900">Usia Peserta</h4>
                        <p class="text-sm text-gray-600 mt-1">Bobot: 30%</p>
                        <p class="text-xs text-gray-500 mt-1">Optimal 18-30 tahun</p>
                    </div>

                    <div class="text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-900">Pendidikan</h4>
                        <p class="text-sm text-gray-600 mt-1">Bobot: 20%</p>
                        <p class="text-xs text-gray-500 mt-1">Tingkat pendidikan</p>
                    </div>

                    <div class="text-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-900">Kelengkapan Dokumen</h4>
                        <p class="text-sm text-gray-600 mt-1">Bobot: 10%</p>
                        <p class="text-xs text-gray-500 mt-1">Persentase dokumen lengkap</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simulasi Hasil Penjadwalan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @if (isset($simulasi['jadwal']) && count($simulasi['jadwal']) > 0)
            @foreach ($simulasi['jadwal'] as $jadwal)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold text-gray-900">{{ $jadwal['nama_batch'] }}</h3>
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                {{ count($jadwal['peserta_terjadwal']) }}/{{ $jadwal['kapasitas'] }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ \Carbon\Carbon::parse($jadwal['tanggal_keberangkatan'])->format('d M Y') }}</p>

                        <!-- Progress Bar -->
                        <div class="mt-3">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full"
                                    style="width: {{ $jadwal['kapasitas'] > 0 ? (count($jadwal['peserta_terjadwal']) / $jadwal['kapasitas']) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-4">
                        @if (count($jadwal['peserta_terjadwal']) > 0)
                            <div class="space-y-3 max-h-64 overflow-y-auto">
                                @foreach ($jadwal['peserta_terjadwal'] as $peserta)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $peserta['nama'] }}</p>
                                            <p class="text-xs text-gray-500">{{ $peserta['nomor_pendaftaran'] }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span
                                                class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">
                                                {{ number_format($peserta['prioritas'], 1) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6">
                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                <p class="text-sm text-gray-500">Belum ada peserta terjadwal</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Peserta Tidak Terjadwal -->
    @if (isset($simulasi['tidak_terjadwal']) && count($simulasi['tidak_terjadwal']) > 0)
        <div class="mt-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 text-red-600">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                        Peserta Tidak Dapat Dijadwalkan ({{ count($simulasi['tidak_terjadwal']) }})
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Peserta berikut tidak dapat dijadwalkan karena kapasitas jadwal
                        penuh</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($simulasi['tidak_terjadwal'] as $peserta)
                            <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $peserta['nama'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $peserta['nomor_pendaftaran'] }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">
                                        {{ number_format($peserta['prioritas'], 1) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-yellow-800">Rekomendasi</h4>
                                <p class="mt-1 text-sm text-yellow-700">
                                    Pertimbangkan untuk menambah jadwal keberangkatan baru atau meningkatkan kapasitas
                                    jadwal yang ada.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (!isset($simulasi['jadwal']) || count($simulasi['jadwal']) == 0)
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Jadwal Tersedia</h3>
            <p class="text-gray-600 mb-4">Belum ada jadwal keberangkatan yang tersedia atau semua jadwal sudah penuh.</p>
            <a href="{{ route('admin.jadwal.create') }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Buat Jadwal Baru
            </a>
        </div>
    @endif

    <script>
        function refreshSimulation() {
            window.location.reload();
        }
    </script>
@endsection
