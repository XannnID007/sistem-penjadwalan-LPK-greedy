@extends('layouts.admin')

@section('title', 'Laporan Pendaftaran')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Laporan Pendaftaran</h1>
                <p class="text-gray-600 mt-1">Data lengkap pendaftaran peserta LPK Jepang</p>
            </div>
            <a href="{{ route('admin.laporan.index') }}"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                Kembali
            </a>
        </div>
    </div>

    <!-- Filter & Export -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="p-6">
            <form method="GET" action="{{ route('admin.laporan.pendaftaran') }}"
                class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                <div>
                    <label for="dari" class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                    <input type="date" name="dari" id="dari" value="{{ request('dari') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">
                </div>

                <div>
                    <label for="sampai" class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                    <input type="date" name="sampai" id="sampai" value="{{ request('sampai') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="terverifikasi" {{ request('status') == 'terverifikasi' ? 'selected' : '' }}>
                            Terverifikasi</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="terjadwal" {{ request('status') == 'terjadwal' ? 'selected' : '' }}>Terjadwal
                        </option>
                    </select>
                </div>

                <div>
                    <button type="submit"
                        class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Filter
                    </button>
                </div>

                <div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.laporan.export.excel', request()->all()) }}"
                            class="flex-1 px-3 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 text-center">
                            Excel
                        </a>
                        <a href="{{ route('admin.laporan.export.pdf', request()->all()) }}"
                            class="flex-1 px-3 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 text-center">
                            PDF
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    @php
        $stats = [
            'total' => $pendaftaran->count(),
            'menunggu' => $pendaftaran->where('status', 'menunggu')->count(),
            'terverifikasi' => $pendaftaran->where('status', 'terverifikasi')->count(),
            'ditolak' => $pendaftaran->where('status', 'ditolak')->count(),
            'terjadwal' => $pendaftaran->where('status', 'terjadwal')->count(),
        ];
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 text-center">
            <p class="text-sm font-medium text-gray-500">Total</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 text-center">
            <p class="text-sm font-medium text-gray-500">Menunggu</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['menunggu'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 text-center">
            <p class="text-sm font-medium text-gray-500">Terverifikasi</p>
            <p class="text-2xl font-bold text-green-600">{{ $stats['terverifikasi'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 text-center">
            <p class="text-sm font-medium text-gray-500">Ditolak</p>
            <p class="text-2xl font-bold text-red-600">{{ $stats['ditolak'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 text-center">
            <p class="text-sm font-medium text-gray-500">Terjadwal</p>
            <p class="text-2xl font-bold text-purple-600">{{ $stats['terjadwal'] }}</p>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">
                Data Pendaftaran ({{ $pendaftaran->count() }} hasil)
            </h3>
        </div>

        @if ($pendaftaran->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No. Pendaftaran
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Peserta
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kontak
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Usia
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pendidikan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Daftar
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Verifikator
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pendaftaran as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->nomor_pendaftaran }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            @if ($item->user->foto_profil)
                                                <img class="h-8 w-8 rounded-full object-cover"
                                                    src="{{ asset('storage/' . $item->user->foto_profil) }}"
                                                    alt="Foto profil">
                                            @else
                                                <div
                                                    class="h-8 w-8 bg-green-500 rounded-full flex items-center justify-center">
                                                    <span
                                                        class="text-white text-xs font-medium">{{ substr($item->user->nama, 0, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->user->nama }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->user->email }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->user->no_telepon ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if ($item->user->tanggal_lahir)
                                        {{ $item->user->tanggal_lahir->age }} tahun
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->user->pendidikan_terakhir ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if ($item->status == 'menunggu') bg-yellow-100 text-yellow-800
                                    @elseif($item->status == 'terverifikasi') bg-green-100 text-green-800
                                    @elseif($item->status == 'ditolak') bg-red-100 text-red-800
                                    @else bg-purple-100 text-purple-800 @endif">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>{{ $item->created_at->format('d M Y') }}</div>
                                    <div class="text-xs">{{ $item->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->verifikator->nama ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-6 text-center">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Data</h3>
                <p class="text-gray-600">Tidak ada data pendaftaran yang sesuai dengan filter yang dipilih.</p>
            </div>
        @endif
    </div>
@endsection
