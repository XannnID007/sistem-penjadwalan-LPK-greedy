{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="text-gray-600 mt-1">Selamat datang di sistem manajemen LPK Jepang</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Pendaftar</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_pendaftar'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Menunggu Verifikasi</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['menunggu_verifikasi'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Terverifikasi</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['terverifikasi'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Terjadwal</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['terjadwal'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pendaftaran Terbaru -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Pendaftaran Terbaru</h3>
                    <a href="{{ route('admin.pendaftaran.index') }}"
                        class="p-2 text-green-600 hover:text-green-700 hover:bg-green-50 rounded-lg transition-all duration-200"
                        title="Lihat Semua">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if ($pendaftaran_terbaru->count() > 0)
                    <div class="space-y-4">
                        @foreach ($pendaftaran_terbaru as $pendaftaran)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                        <span
                                            class="text-white text-sm font-medium">{{ substr($pendaftaran->user->nama, 0, 1) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $pendaftaran->user->nama }}</p>
                                        <p class="text-xs text-gray-500">{{ $pendaftaran->nomor_pendaftaran }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full
                                    @if ($pendaftaran->status == 'menunggu') bg-yellow-100 text-yellow-800
                                    @elseif($pendaftaran->status == 'terverifikasi') bg-green-100 text-green-800
                                    @elseif($pendaftaran->status == 'ditolak') bg-red-100 text-red-800
                                    @else bg-purple-100 text-purple-800 @endif">
                                        {{ ucfirst($pendaftaran->status) }}
                                    </span>
                                    <a href="{{ route('admin.pendaftaran.show', $pendaftaran) }}"
                                        class="p-1.5 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-all duration-200"
                                        title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="text-gray-500">Belum ada pendaftaran</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Jadwal Keberangkatan Mendatang -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Jadwal Keberangkatan Mendatang</h3>
                    <a href="{{ route('admin.jadwal.index') }}"
                        class="p-2 text-green-600 hover:text-green-700 hover:bg-green-50 rounded-lg transition-all duration-200"
                        title="Lihat Semua">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if ($jadwal_mendatang->count() > 0)
                    <div class="space-y-4">
                        @foreach ($jadwal_mendatang as $jadwal)
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $jadwal->nama_batch }}</p>
                                        <p class="text-xs text-gray-500">
                                            {{ $jadwal->tanggal_keberangkatan->format('d M Y') }}</p>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $jadwal->terisi }}/{{ $jadwal->kapasitas }}</p>
                                            <div class="w-16 bg-gray-200 rounded-full h-2 mt-1">
                                                <div class="bg-green-500 h-2 rounded-full"
                                                    style="width: {{ ($jadwal->terisi / $jadwal->kapasitas) * 100 }}%">
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('admin.jadwal.show', $jadwal) }}"
                                            class="p-1.5 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-all duration-200"
                                            title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
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
                        <p class="text-gray-500">Belum ada jadwal keberangkatan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
