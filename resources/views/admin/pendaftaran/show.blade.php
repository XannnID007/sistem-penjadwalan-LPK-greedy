@extends('layouts.admin')

@section('title', 'Detail Pendaftaran')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Pendaftaran</h1>
                <p class="text-gray-600 mt-1">{{ $pendaftaran->nomor_pendaftaran }}</p>
            </div>
            <a href="{{ route('admin.pendaftaran.index') }}"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                Kembali
            </a>
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
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Info Peserta -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Data Peserta</h3>
                </div>
                <div class="p-6">
                    <div class="text-center mb-4">
                        @if ($pendaftaran->user->foto_profil)
                            <img class="h-20 w-20 rounded-full object-cover mx-auto"
                                src="{{ asset('storage/' . $pendaftaran->user->foto_profil) }}" alt="Foto profil">
                        @else
                            <div class="h-20 w-20 bg-green-500 rounded-full flex items-center justify-center mx-auto">
                                <span
                                    class="text-white text-2xl font-medium">{{ substr($pendaftaran->user->nama, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                            <p class="text-sm text-gray-900">{{ $pendaftaran->user->nama }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="text-sm text-gray-900">{{ $pendaftaran->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">No. Telepon</p>
                            <p class="text-sm text-gray-900">{{ $pendaftaran->user->no_telepon ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Lahir</p>
                            <p class="text-sm text-gray-900">
                                {{ $pendaftaran->user->tanggal_lahir ? $pendaftaran->user->tanggal_lahir->format('d M Y') : '-' }}
                                @if ($pendaftaran->user->tanggal_lahir)
                                    <span class="text-xs text-gray-500">({{ $pendaftaran->user->tanggal_lahir->age }}
                                        tahun)</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pendidikan</p>
                            <p class="text-sm text-gray-900">{{ $pendaftaran->user->pendidikan_terakhir ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Alamat</p>
                            <p class="text-sm text-gray-900">{{ $pendaftaran->user->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Pendaftaran -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Status Pendaftaran</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Status</p>
                            <span
                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            @if ($pendaftaran->status == 'menunggu') bg-yellow-100 text-yellow-800
                            @elseif($pendaftaran->status == 'terverifikasi') bg-green-100 text-green-800
                            @elseif($pendaftaran->status == 'ditolak') bg-red-100 text-red-800
                            @else bg-purple-100 text-purple-800 @endif">
                                {{ ucfirst($pendaftaran->status) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Daftar</p>
                            <p class="text-sm text-gray-900">{{ $pendaftaran->created_at->format('d M Y H:i') }}</p>
                        </div>
                        @if ($pendaftaran->tanggal_verifikasi)
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tanggal Verifikasi</p>
                                <p class="text-sm text-gray-900">
                                    {{ $pendaftaran->tanggal_verifikasi->format('d M Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Diverifikasi Oleh</p>
                                <p class="text-sm text-gray-900">{{ $pendaftaran->verifikator->nama ?? '-' }}</p>
                            </div>
                        @endif
                        @if ($pendaftaran->catatan)
                            <div>
                                <p class="text-sm font-medium text-gray-500">Catatan</p>
                                <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $pendaftaran->catatan }}</p>
                            </div>
                        @endif
                    </div>

                    @if ($pendaftaran->status == 'menunggu')
                        <div class="mt-6 space-y-3">
                            <!-- Form Verifikasi -->
                            <form method="POST" action="{{ route('admin.pendaftaran.verifikasi', $pendaftaran) }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">Catatan
                                        Verifikasi</label>
                                    <textarea id="catatan" name="catatan" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500"
                                        placeholder="Catatan opsional untuk peserta..."></textarea>
                                </div>
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 mb-2">
                                    Verifikasi Pendaftaran
                                </button>
                            </form>

                            <!-- Form Tolak -->
                            <button onclick="document.getElementById('tolak-modal').style.display='block'"
                                class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                Tolak Pendaftaran
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Dokumen -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Dokumen Pendukung ({{ $pendaftaran->dokumen->count() }})
                    </h3>
                </div>
                <div class="p-6">
                    @if ($pendaftaran->dokumen->count() > 0)
                        <div class="space-y-4">
                            @foreach ($pendaftaran->dokumen as $dokumen)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="p-2 bg-blue-100 rounded-lg">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
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
                                                    {{ $dokumen->created_at->format('d M Y H:i') }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <span
                                                class="px-2 py-1 text-xs font-medium rounded-full
                                            @if ($dokumen->status == 'menunggu') bg-yellow-100 text-yellow-800
                                            @elseif($dokumen->status == 'diterima') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($dokumen->status) }}
                                            </span>
                                            <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-700 text-sm">
                                                Lihat File
                                            </a>
                                        </div>
                                    </div>

                                    @if ($dokumen->keterangan)
                                        <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                            <p class="text-xs text-gray-600">{{ $dokumen->keterangan }}</p>
                                        </div>
                                    @endif

                                    @if ($dokumen->status == 'menunggu')
                                        <div class="mt-3">
                                            <form method="POST"
                                                action="{{ route('admin.pendaftaran.dokumen.verifikasi', $dokumen) }}"
                                                class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                                @csrf
                                                <div>
                                                    <select name="status" required
                                                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">
                                                        <option value="">Pilih Status</option>
                                                        <option value="diterima">Terima</option>
                                                        <option value="ditolak">Tolak</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <input type="text" name="keterangan"
                                                        placeholder="Keterangan (opsional)"
                                                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500">
                                                </div>
                                                <div>
                                                    <button type="submit"
                                                        class="w-full px-3 py-2 bg-green-600 text-white text-sm rounded-md hover:bg-green-700">
                                                        Update Status
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
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
                            <p class="text-gray-500">Belum ada dokumen yang diupload</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tolak Pendaftaran -->
    <div id="tolak-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tolak Pendaftaran</h3>
                    <button onclick="document.getElementById('tolak-modal').style.display='none'"
                        class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('admin.pendaftaran.tolak', $pendaftaran) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="catatan_tolak" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan
                            *</label>
                        <textarea id="catatan_tolak" name="catatan" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500"
                            placeholder="Jelaskan alasan penolakan pendaftaran..."></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="document.getElementById('tolak-modal').style.display='none'"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Tolak Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
