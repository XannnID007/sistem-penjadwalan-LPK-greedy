@extends('layouts.admin')

@section('title', 'Detail Jadwal')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Jadwal Keberangkatan</h1>
                <p class="text-gray-600 mt-1">{{ $jadwal->nama_batch }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.jadwal.edit', $jadwal) }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Edit Jadwal
                </a>
                <a href="{{ route('admin.jadwal.index') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Info Jadwal -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Jadwal</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nama Batch</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $jadwal->nama_batch }}</p>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Keberangkatan</p>
                            <p class="text-sm text-gray-900">{{ $jadwal->tanggal_keberangkatan->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $jadwal->tanggal_keberangkatan->diffForHumans() }}</p>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-500">Status</p>
                            <span
                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            @if ($jadwal->keterangan) <div>
                            <p class="text-sm font-medium text-gray-500">Keterangan</p>
                            <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $jadwal->keterangan }}</p>
                        </div> @endif
                    
                    <div>
                        <p class="text-sm
                                font-medium text-gray-500">Dibuat</p>
                                <p class="text-sm text-gray-900">{{ $jadwal->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Peserta -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Daftar Peserta ({{ $jadwal->peserta->count() }})
                    </h3>
                </div>
                <div class="p-6">
                    @if ($jadwal->peserta->count() > 0)
                        <div class="space-y-4">
                            @foreach ($jadwal->peserta as $pesertaJadwal)
                                @php $peserta = $pesertaJadwal->pendaftaran; @endphp
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        @if ($peserta->user->foto_profil)
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ asset('storage/' . $peserta->user->foto_profil) }}"
                                                alt="Foto profil">
                                        @else
                                            <div
                                                class="h-10 w-10 bg-green-500 rounded-full flex items-center justify-center">
                                                <span
                                                    class="text-white text-sm font-medium">{{ substr($peserta->user->nama, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $peserta->user->nama }}</p>
                                            <p class="text-xs text-gray-500">{{ $peserta->nomor_pendaftaran }}</p>
                                            <p class="text-xs text-gray-500">{{ $peserta->user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-500">Dijadwalkan</p>
                                        <p class="text-xs text-gray-900">
                                            {{ $pesertaJadwal->tanggal_dijadwalkan->format('d M Y') }}</p>
                                        <a href="{{ route('admin.pendaftaran.show', $peserta) }}"
                                            class="text-xs text-blue-600 hover:text-blue-700">
                                            Lihat Detail
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
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Peserta</h3>
                            <p class="text-gray-600 mb-4">Belum ada peserta yang dijadwalkan untuk batch ini.</p>
                            <a href="{{ route('admin.penjadwalan.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Jalankan Penjadwalan
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
