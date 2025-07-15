@extends('layouts.admin')

@section('title', 'Detail Peserta')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Peserta</h1>
                <p class="text-gray-600 mt-1">{{ $user->nama }}</p>
            </div>
            <a href="{{ route('admin.peserta.index') }}"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profil Peserta -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Profil Peserta</h3>
                </div>
                <div class="p-6">
                    <div class="text-center mb-6">
                        @if ($user->foto_profil)
                            <img class="h-24 w-24 rounded-full object-cover mx-auto border-4 border-green-100"
                                src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto profil">
                        @else
                            <div
                                class="h-24 w-24 bg-green-500 rounded-full flex items-center justify-center mx-auto border-4 border-green-100">
                                <span class="text-white text-3xl font-medium">{{ substr($user->nama, 0, 1) }}</span>
                            </div>
                        @endif
                        <h4 class="text-lg font-semibold text-gray-900 mt-3">{{ $user->nama }}</h4>
                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">No. Telepon</p>
                            <p class="text-sm text-gray-900">{{ $user->no_telepon ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Lahir</p>
                            <p class="text-sm text-gray-900">
                                {{ $user->tanggal_lahir ? $user->tanggal_lahir->format('d M Y') : '-' }}
                                @if ($user->tanggal_lahir)
                                    <span class="text-xs text-gray-500">({{ $user->tanggal_lahir->age }} tahun)</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pendidikan Terakhir</p>
                            <p class="text-sm text-gray-900">{{ $user->pendidikan_terakhir ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Alamat</p>
                            <p class="text-sm text-gray-900">{{ $user->alamat ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Bergabung</p>
                            <p class="text-sm text-gray-900">{{ $user->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Pendaftaran & Jadwal -->
        <div class="lg:col-span-2">
            @if ($user->pendaftaran)
                <!-- Status Pendaftaran -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Status Pendaftaran</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nomor Pendaftaran</p>
                                <p class="text-lg font-semibold text-green-600">{{ $user->pendaftaran->nomor_pendaftaran }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                @if ($user->pendaftaran->status == 'menunggu') bg-yellow-100 text-yellow-800
                                @elseif($user->pendaftaran->status == 'terverifikasi') bg-green-100 text-green-800
                                @elseif($user->pendaftaran->status == 'ditolak') bg-red-100 text-red-800
                                @else bg-purple-100 text-purple-800 @endif">
                                    {{ ucfirst($user->pendaftaran->status) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal Daftar</p>
                                <p class="text-sm text-gray-900">{{ $user->pendaftaran->created_at->format('d M Y H:i') }}
                                </p>
                            </div>
                            @if ($user->pendaftaran->tanggal_verifikasi)
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Tanggal Verifikasi</p>
                                    <p class="text-sm text-gray-900">
                                        {{ $user->pendaftaran->tanggal_verifikasi->format('d M Y H:i') }}</p>
                                </div>
                            @endif
                        </div>

                        @if ($user->pendaftaran->catatan)
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-500">Catatan</p>
                                <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg">
                                    {{ $user->pendaftaran->catatan }}</p>
                            </div>
                        @endif

                        <div class="mt-4 flex space-x-3">
                            <a href="{{ route('admin.pendaftaran.show', $user->pendaftaran) }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                Lihat Detail Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Keberangkatan -->
                @if ($user->pendaftaran->jadwal)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Jadwal Keberangkatan</h3>
                        </div>
                        <div class="p-6">
                            @php $jadwal = $user->pendaftaran->jadwal->jadwal; @endphp
                            <div class="flex items-center p-4 bg-green-50 rounded-lg">
                                <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $jadwal->nama_batch }}</h4>
                                    <p class="text-sm text-gray-600">{{ $jadwal->tanggal_keberangkatan->format('d M Y') }}
                                    </p>
                                    <p class="text-xs text-gray-500">Dijadwalkan:
                                        {{ $user->pendaftaran->jadwal->tanggal_dijadwalkan->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Dokumen -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Dokumen ({{ $user->pendaftaran->dokumen->count() }})
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($user->pendaftaran->dokumen->count() > 0)
                            <div class="space-y-3">
                                @foreach ($user->pendaftaran->dokumen as $dokumen)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="p-2 bg-blue-100 rounded-lg">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">{{ $dokumen->nama_dokumen }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $dokumen->created_at->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="px-2 py-1 text-xs font-medium rounded-full
                                            @if ($dokumen->status == 'menunggu') bg-yellow-100 text-yellow-800
                                            @elseif($dokumen->status == 'diterima') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($dokumen->status) }}
                                            </span>
                                            <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-700 text-xs">
                                                Lihat
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">Belum ada dokumen yang diupload</p>
                        @endif
                    </div>
                </div>
            @else
                <!-- Belum Mendaftar -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Mendaftar</h3>
                            <p class="text-gray-600">Peserta ini belum mendaftar program LPK Jepang.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
