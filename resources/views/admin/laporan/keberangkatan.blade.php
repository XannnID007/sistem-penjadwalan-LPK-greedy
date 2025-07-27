@extends('layouts.admin')

@section('title', 'Laporan Keberangkatan')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Laporan Keberangkatan</h1>
                <p class="text-gray-600 mt-1">Data jadwal dan peserta keberangkatan</p>
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
            <form method="GET" action="{{ route('admin.laporan.keberangkatan') }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
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
                        <a href="{{ route('admin.laporan.export.excel', array_merge(request()->all(), ['type' => 'jadwal'])) }}"
                            class="flex-1 px-3 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 text-center">
                            Excel
                        </a>
                        <a href="{{ route('admin.laporan.export.pdf', array_merge(request()->all(), ['type' => 'jadwal'])) }}"
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
        $totalJadwal = $jadwal->count();
        $totalPeserta = $jadwal->sum(function ($j) {
            return $j->peserta->count();
        });
        $totalKapasitas = $jadwal->sum('kapasitas');
        $sisaKapasitas = $totalKapasitas - $jadwal->sum('terisi');
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 text-center">
            <p class="text-sm font-medium text-gray-500">Total Jadwal</p>
            <p class="text-2xl font-bold text-blue-600">{{ $totalJadwal }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 text-center">
            <p class="text-sm font-medium text-gray-500">Total Peserta</p>
            <p class="text-2xl font-bold text-green-600">{{ $totalPeserta }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 text-center">
            <p class="text-sm font-medium text-gray-500">Total Kapasitas</p>
            <p class="text-2xl font-bold text-purple-600">{{ $totalKapasitas }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 text-center">
            <p class="text-sm font-medium text-gray-500">Sisa Kapasitas</p>
            <p class="text-2xl font-bold text-orange-600">{{ $sisaKapasitas }}</p>
        </div>
    </div>

    <!-- Data Jadwal -->
    <div class="space-y-6">
        @if ($jadwal->count() > 0)
            @foreach ($jadwal as $item)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $item->nama_batch }}</h3>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="text-sm text-gray-600">
                                        📅 {{ $item->tanggal_keberangkatan->format('d M Y') }}
                                    </span>
                                    <span class="text-sm text-gray-600">
                                        👥 {{ $item->terisi }}/{{ $item->kapasitas }} peserta
                                    </span>
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full
                                    @if ($item->status == 'aktif') bg-green-100 text-green-800
                                    @elseif($item->status == 'penuh') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <!-- Progress Bar -->
                                <div class="w-32">
                                    <div class="flex justify-between text-xs text-gray-600 mb-1">
                                        <span>Kapasitas</span>
                                        <span>{{ round(($item->terisi / $item->kapasitas) * 100) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full transition-all duration-300"
                                            style="width: {{ ($item->terisi / $item->kapasitas) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($item->keterangan)
                            <p class="text-sm text-gray-600 mt-3 bg-gray-50 p-3 rounded-lg">{{ $item->keterangan }}</p>
                        @endif
                    </div>

                    @if ($item->peserta->count() > 0)
                        <div class="p-6">
                            <h4 class="text-sm font-medium text-gray-900 mb-4">
                                Daftar Peserta ({{ $item->peserta->count() }})
                            </h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No
                                            </th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No.
                                                Pendaftaran</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama
                                                Peserta</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                Email</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                Telepon</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Usia
                                            </th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                Pendidikan</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                Dijadwalkan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($item->peserta as $index => $pesertaJadwal)
                                            @php $peserta = $pesertaJadwal->pendaftaran; @endphp
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-2 text-sm text-gray-900">{{ $index + 1 }}</td>
                                                <td class="px-4 py-2 text-sm font-medium text-gray-900">
                                                    {{ $peserta->nomor_pendaftaran }}
                                                </td>
                                                <td class="px-4 py-2">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-6 w-6">
                                                            @if ($peserta->user->foto_profil)
                                                                <img class="h-6 w-6 rounded-full object-cover"
                                                                    src="{{ asset('storage/' . $peserta->user->foto_profil) }}"
                                                                    alt="Foto profil">
                                                            @else
                                                                <div
                                                                    class="h-6 w-6 bg-green-500 rounded-full flex items-center justify-center">
                                                                    <span
                                                                        class="text-white text-xs font-medium">{{ substr($peserta->user->nama, 0, 1) }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-2">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $peserta->user->nama }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-500">{{ $peserta->user->email }}
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                    {{ $peserta->user->no_telepon ?? '-' }}</td>
                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                    @if ($peserta->user->tanggal_lahir)
                                                        {{ $peserta->user->tanggal_lahir->age }} tahun
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                    {{ $peserta->user->pendidikan_terakhir ?? '-' }}</td>
                                                <td class="px-4 py-2 text-sm text-gray-500">
                                                    {{ $pesertaJadwal->tanggal_dijadwalkan->format('d M Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="p-6 text-center text-gray-500">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <p class="text-sm">Belum ada peserta terjadwal</p>
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 text-center">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Data</h3>
                    <p class="text-gray-600">Tidak ada jadwal keberangkatan yang sesuai dengan filter yang dipilih.</p>
                </div>
            </div>
        @endif
    </div>
@endsection
