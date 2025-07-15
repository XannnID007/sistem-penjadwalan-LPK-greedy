{{-- resources/views/peserta/pendaftaran/show.blade.php --}}
@extends('layouts.peserta')

@section('title', 'Detail Pendaftaran')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Pendaftaran</h1>
                <p class="text-gray-600 mt-1">{{ $pendaftaran->nomor_pendaftaran }}</p>
            </div>
            <a href="{{ route('peserta.pendaftaran.index') }}"
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

    @if (session('error'))
        <div class="mb-6 bg-red-50 border border-red-300 rounded-md p-4">
            <div class="flex">
                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Info Pendaftaran -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Pendaftaran</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nomor Pendaftaran</p>
                            <p class="text-lg font-bold text-green-600">{{ $pendaftaran->nomor_pendaftaran }}</p>
                        </div>
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
                                <p class="text-sm text-gray-900">{{ $pendaftaran->tanggal_verifikasi->format('d M Y H:i') }}
                                </p>
                            </div>
                        @endif
                        @if ($pendaftaran->catatan)
                            <div>
                                <p class="text-sm font-medium text-gray-500">Catatan Admin</p>
                                <div class="mt-1 p-3 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-gray-900">{{ $pendaftaran->catatan }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Progress Status -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Progress Pendaftaran</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
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

                        <!-- Step 2: Upload Dokumen -->
                        <div class="flex items-center">
                            <div
                                class="w-8 h-8 {{ $pendaftaran->dokumen->count() > 0 ? 'bg-green-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center">
                                @if ($pendaftaran->dokumen->count() > 0)
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <span class="text-xs text-gray-600">2</span>
                                @endif
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Upload Dokumen</p>
                                <p class="text-xs text-gray-500">
                                    {{ $pendaftaran->dokumen->count() > 0 ? $pendaftaran->dokumen->count() . ' dokumen' : 'Belum upload' }}
                                </p>
                            </div>
                        </div>

                        <!-- Step 3: Verifikasi -->
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
                                    <span class="text-xs text-gray-600">3</span>
                                @endif
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Verifikasi</p>
                                <p class="text-xs text-gray-500">
                                    @if ($pendaftaran->status == 'menunggu')
                                        Menunggu
                                    @elseif($pendaftaran->status == 'terverifikasi')
                                        Terverifikasi
                                    @elseif($pendaftaran->status == 'ditolak')
                                        Ditolak
                                    @else
                                        Terjadwal
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Step 4: Penjadwalan -->
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
                                    <span class="text-xs text-gray-600">4</span>
                                @endif
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Penjadwalan</p>
                                <p class="text-xs text-gray-500">
                                    {{ $pendaftaran->status == 'terjadwal' ? 'Terjadwal' : 'Menunggu' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Dokumen -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Dokumen Pendukung ({{ $pendaftaran->dokumen->count() }})
                        </h3>
                        @if ($pendaftaran->status == 'menunggu')
                            <button onclick="document.getElementById('upload-modal').style.display='block'"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Upload Dokumen
                            </button>
                        @endif
                    </div>
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
                                                <p class="text-xs text-gray-500">{{ $dokumen->keterangan }}</p>
                                                <p class="text-xs text-gray-400">
                                                    Upload: {{ $dokumen->created_at->format('d M Y H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank"
                                                class="px-3 py-1 bg-blue-100 text-blue-600 text-xs rounded-md hover:bg-blue-200 transition-colors">
                                                Lihat
                                            </a>
                                            @if ($pendaftaran->status == 'menunggu')
                                                <form action="{{ route('peserta.dokumen.destroy', $dokumen->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-red-100 text-red-600 text-xs rounded-md hover:bg-red-200 transition-colors">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada dokumen</h3>
                            <p class="text-gray-500 mb-4">Silakan upload dokumen pendukung untuk melengkapi pendaftaran
                                Anda</p>
                            @if ($pendaftaran->status == 'menunggu')
                                <button onclick="document.getElementById('upload-modal').style.display='block'"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                    Upload Dokumen Pertama
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Informasi Jadwal (jika ada) -->
            @if ($pendaftaran->status == 'terjadwal' && $pendaftaran->jadwal)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mt-6">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Jadwal</h3>
                    </div>
                    <div class="p-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900">
                                        {{ $pendaftaran->jadwal->tanggal->format('d M Y') }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        {{ $pendaftaran->jadwal->waktu_mulai }} -
                                        {{ $pendaftaran->jadwal->waktu_selesai }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        {{ $pendaftaran->jadwal->tempat }}
                                    </p>
                                </div>
                            </div>
                            @if ($pendaftaran->jadwal->keterangan)
                                <div class="mt-3 pt-3 border-t border-blue-200">
                                    <p class="text-sm text-gray-700">{{ $pendaftaran->jadwal->keterangan }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Upload Dokumen -->
    <div id="upload-modal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Upload Dokumen</h3>
                        <button onclick="document.getElementById('upload-modal').style.display='none'"
                            class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <form action="{{ route('peserta.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaran->id }}">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Dokumen</label>
                            <input type="text" name="nama_dokumen"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                placeholder="Misal: KTP, Ijazah, Sertifikat" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                            <textarea name="keterangan"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                rows="3" placeholder="Deskripsi singkat tentang dokumen"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">File Dokumen</label>
                            <input type="file" name="file"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                accept=".pdf,.jpg,.jpeg,.png" required>
                            <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG. Max: 2MB</p>
                        </div>
                    </div>
                    <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                        <button type="button" onclick="document.getElementById('upload-modal').style.display='none'"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Tutup modal saat klik di luar area modal
            document.getElementById('upload-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                }
            });

            // Tutup modal dengan tombol ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    document.getElementById('upload-modal').style.display = 'none';
                }
            });
        </script>
    @endpush
@endsection
