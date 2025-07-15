@extends('layouts.peserta')

@section('title', 'Jadwal Keberangkatan')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Jadwal Keberangkatan</h1>
        <p class="text-gray-600 mt-1">Lihat jadwal keberangkatan yang tersedia dan status Anda</p>
    </div>

    @if ($jadwalPeserta)
        <!-- Jadwal Peserta -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 mb-6 text-white">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-bold">Anda Sudah Terjadwal!</h3>
                    <p class="text-green-100 mt-1">Selamat! Anda telah dijadwalkan untuk keberangkatan</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Jadwal Keberangkatan Anda</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">{{ $jadwalPeserta->nama_batch }}</h4>
                                <p class="text-sm text-gray-600">Batch Keberangkatan</p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal Keberangkatan</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $jadwalPeserta->tanggal_keberangkatan->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ $jadwalPeserta->tanggal_keberangkatan->diffForHumans() }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500">Kapasitas Batch</p>
                                <p class="text-sm text-gray-900">
                                    {{ $jadwalPeserta->terisi }}/{{ $jadwalPeserta->kapasitas }} peserta</p>
                                <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                    <div class="bg-green-500 h-2 rounded-full"
                                        style="width: {{ ($jadwalPeserta->terisi / $jadwalPeserta->kapasitas) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        @if ($jadwalPeserta->keterangan)
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h5 class="text-sm font-medium text-blue-900 mb-2">Keterangan Program</h5>
                                <p class="text-sm text-blue-700">{{ $jadwalPeserta->keterangan }}</p>
                            </div>
                        @endif

                        <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-yellow-900 mb-2">Persiapan Keberangkatan</h5>
                            <ul class="text-sm text-yellow-700 space-y-1">
                                <li>• Siapkan dokumen perjalanan</li>
                                <li>• Ikuti pelatihan bahasa Jepang</li>
                                <li>• Persiapkan kebutuhan pribadi</li>
                                <li>• Koordinasi dengan tim LPK</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Jadwal Tersedia -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                @if ($jadwalPeserta)
                    Jadwal Keberangkatan Lainnya
                @else
                    Jadwal Keberangkatan Tersedia
                @endif
            </h3>
            <p class="text-sm text-gray-600 mt-1">
                @if ($pendaftaran && $pendaftaran->status === 'terjadwal')
                    Jadwal keberangkatan lain yang tersedia
                @elseif($pendaftaran && $pendaftaran->status === 'terverifikasi')
                    Anda akan dijadwalkan secara otomatis oleh admin
                @elseif($pendaftaran && $pendaftaran->status === 'menunggu')
                    Selesaikan verifikasi untuk dapat dijadwalkan
                @else
                    Daftar terlebih dahulu untuk dapat melihat jadwal
                @endif
            </p>
        </div>
        <div class="p-6">
            @if ($jadwalTersedia->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($jadwalTersedia as $jadwal)
                        <div
                            class="border border-gray-200 rounded-lg p-4 {{ $jadwalPeserta && $jadwalPeserta->id === $jadwal->id ? 'ring-2 ring-green-500 bg-green-50' : '' }}">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-semibold text-gray-900">{{ $jadwal->nama_batch }}</h4>
                                @if ($jadwalPeserta && $jadwalPeserta->id === $jadwal->id)
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                        Jadwal Anda
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                        {{ $jadwal->status }}
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-2 mb-3">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $jadwal->tanggal_keberangkatan->format('d M Y') }}
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    {{ $jadwal->terisi }}/{{ $jadwal->kapasitas }} peserta
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mb-3">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full"
                                        style="width: {{ ($jadwal->terisi / $jadwal->kapasitas) * 100 }}%"></div>
                                </div>
                            </div>

                            @if ($jadwal->keterangan)
                                <p class="text-xs text-gray-600">{{ Str::limit($jadwal->keterangan, 80) }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Jadwal Tersedia</h3>
                    <p class="text-gray-600">Jadwal keberangkatan akan segera diumumkan.</p>
                </div>
            @endif
        </div>
    </div>

    @if (!$pendaftaran)
        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3">
                    <h4 class="text-sm font-medium text-yellow-800">Belum Mendaftar</h4>
                    <p class="mt-1 text-sm text-yellow-700">
                        Untuk dapat dijadwalkan, Anda harus mendaftar program LPK terlebih dahulu.
                        <a href="{{ route('peserta.pendaftaran.create') }}" class="font-medium underline">Daftar
                            sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    @endif
@endsection
