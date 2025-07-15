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

    {{-- Document Requirements Section --}}
    @if ($pendaftaran->status == 'menunggu')
        @php
            // Define uploaded documents array FIRST before using it
            $uploadedDocs = $pendaftaran->dokumen->pluck('nama_dokumen')->toArray();
        @endphp

        <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-lg font-semibold text-blue-900 mb-3">Dokumen Yang Diperlukan</h3>
                        <p class="text-sm text-blue-800 mb-4">Silakan upload semua dokumen berikut untuk melengkapi
                            pendaftaran Anda:</p>

                        @php
                            $requiredDocs = [
                                [
                                    'name' => 'KTP',
                                    'description' => 'Kartu Tanda Penduduk yang masih berlaku',
                                    'icon' => 'id-card',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'Ijazah Terakhir',
                                    'description' => 'Ijazah pendidikan terakhir (SMP/SMA/SMK/D3/S1)',
                                    'icon' => 'certificate',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'Transkrip Nilai',
                                    'description' => 'Transkrip nilai pendidikan terakhir',
                                    'icon' => 'document-text',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'Surat Keterangan Sehat',
                                    'description' => 'Dari dokter/puskesmas (maksimal 3 bulan)',
                                    'icon' => 'heart',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'Surat Keterangan Kelakuan Baik (SKKB)',
                                    'description' => 'Dari Polsek setempat (maksimal 6 bulan)',
                                    'icon' => 'shield-check',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'Pas Foto',
                                    'description' => 'Pas foto 4x6 dengan latar belakang merah',
                                    'icon' => 'camera',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'Kartu Keluarga',
                                    'description' => 'Kartu Keluarga asli/fotokopi',
                                    'icon' => 'users',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'Sertifikat Keterampilan',
                                    'description' => 'Sertifikat kursus/pelatihan (jika ada)',
                                    'icon' => 'academic-cap',
                                    'required' => false,
                                ],
                                [
                                    'name' => 'Surat Pengalaman Kerja',
                                    'description' => 'Surat keterangan pengalaman kerja (jika ada)',
                                    'icon' => 'briefcase',
                                    'required' => false,
                                ],
                            ];
                        @endphp

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($requiredDocs as $doc)
                                @php
                                    $isUploaded = in_array($doc['name'], $uploadedDocs);
                                @endphp
                                <div
                                    class="flex items-center p-3 {{ $isUploaded ? 'bg-green-50 border border-green-200' : 'bg-white border border-gray-200' }} rounded-lg">
                                    <div class="flex-shrink-0">
                                        @if ($isUploaded)
                                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        @else
                                            <div
                                                class="w-6 h-6 {{ $doc['required'] ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-400' }} rounded-full flex items-center justify-center">
                                                @if ($doc['required'])
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center">
                                            <p
                                                class="text-sm font-medium {{ $isUploaded ? 'text-green-900' : 'text-gray-900' }}">
                                                {{ $doc['name'] }}
                                            </p>
                                            @if ($doc['required'])
                                                <span
                                                    class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full">Wajib</span>
                                            @else
                                                <span
                                                    class="ml-2 text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">Opsional</span>
                                            @endif
                                        </div>
                                        <p class="text-xs {{ $isUploaded ? 'text-green-700' : 'text-gray-600' }}">
                                            {{ $doc['description'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-yellow-800">Catatan Penting:</h4>
                                    <ul class="mt-1 text-sm text-yellow-700 list-disc list-inside space-y-1">
                                        <li>Semua dokumen wajib harus diupload untuk proses verifikasi</li>
                                        <li>Format file yang diterima: PDF, JPG, PNG (maksimal 2MB)</li>
                                        <li>Pastikan dokumen terlihat jelas dan tidak buram</li>
                                        <li>Dokumen harus asli atau fotokopi yang telah dilegalisir</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Define $uploadedDocs for other sections as well --}}
    @php
        $uploadedDocs = $pendaftaran->dokumen->pluck('nama_dokumen')->toArray();
    @endphp

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
                                <p class="text-sm text-gray-900">
                                    {{ $pendaftaran->tanggal_verifikasi->format('d M Y H:i') }}
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
                            @php
                                $requiredDocsCount = 7; // Jumlah dokumen wajib
                                $uploadedRequiredDocs = 0;
                                $requiredDocNames = [
                                    'KTP',
                                    'Ijazah Terakhir',
                                    'Transkrip Nilai',
                                    'Surat Keterangan Sehat',
                                    'Surat Keterangan Kelakuan Baik (SKKB)',
                                    'Pas Foto',
                                    'Kartu Keluarga',
                                ];

                                foreach ($requiredDocNames as $docName) {
                                    if (in_array($docName, $uploadedDocs)) {
                                        $uploadedRequiredDocs++;
                                    }
                                }

                                $isDocumentComplete = $uploadedRequiredDocs >= $requiredDocsCount;
                            @endphp
                            <div
                                class="w-8 h-8 {{ $isDocumentComplete ? 'bg-green-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center">
                                @if ($isDocumentComplete)
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
                                    {{ $uploadedRequiredDocs }}/{{ $requiredDocsCount }} dokumen wajib
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
                            Dokumen Yang Telah Diupload ({{ $pendaftaran->dokumen->count() }})
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
                                                @if ($dokumen->keterangan)
                                                    <p class="text-xs text-gray-500">{{ $dokumen->keterangan }}</p>
                                                @endif
                                                <p class="text-xs text-gray-400">
                                                    Upload: {{ $dokumen->created_at->format('d M Y H:i') }}
                                                </p>
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
                                                class="px-3 py-1 bg-blue-100 text-blue-600 text-xs rounded-md hover:bg-blue-200 transition-colors">
                                                Lihat
                                            </a>
                                            @if ($pendaftaran->status == 'menunggu')
                                                <form action="{{ route('peserta.dokumen.destroy', $dokumen) }}"
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
        </div>
    </div>

    <!-- Modal Upload Dokumen -->
    <div id="upload-modal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
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
                    <div class="p-6 space-y-4">
                        <!-- Quick Select Buttons -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Cepat Dokumen Wajib</label>
                            <div class="grid grid-cols-2 gap-2 mb-3">
                                @php
                                    $quickSelectDocs = [
                                        'KTP',
                                        'Ijazah Terakhir',
                                        'Transkrip Nilai',
                                        'Surat Keterangan Sehat',
                                        'Surat Keterangan Kelakuan Baik (SKKB)',
                                        'Pas Foto',
                                        'Kartu Keluarga',
                                    ];
                                @endphp
                                @foreach ($quickSelectDocs as $docName)
                                    @if (!in_array($docName, $uploadedDocs))
                                        <button type="button" onclick="selectDocument('{{ $docName }}')"
                                            class="px-3 py-2 text-xs bg-blue-50 text-blue-700 rounded-md hover:bg-blue-100 transition-colors text-left">
                                            {{ $docName }}
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Dokumen *</label>
                            <input type="text" id="nama_dokumen" name="nama_dokumen"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                placeholder="Misal: KTP, Ijazah, Sertifikat" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                            <textarea name="keterangan"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                rows="3" placeholder="Deskripsi singkat tentang dokumen (opsional)"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">File Dokumen *</label>
                            <input type="file" name="file_dokumen" id="file_dokumen"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                accept=".pdf,.jpg,.jpeg,.png" required>
                            <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG. Maksimal: 2MB</p>
                        </div>

                        <!-- File Preview -->
                        <div id="file-preview" class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Preview File</label>
                            <div class="border border-gray-200 rounded-lg p-3">
                                <div id="preview-content" class="flex items-center">
                                    <!-- Content will be populated by JavaScript -->
                                </div>
                            </div>
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

    <script>
        // Function to select document from quick buttons
        function selectDocument(docName) {
            document.getElementById('nama_dokumen').value = docName;

            // Set auto-description based on document type
            const descriptions = {
                'KTP': 'Kartu Tanda Penduduk yang masih berlaku',
                'Ijazah Terakhir': 'Ijazah pendidikan terakhir',
                'Transkrip Nilai': 'Transkrip nilai pendidikan terakhir',
                'Surat Keterangan Sehat': 'Surat keterangan sehat dari dokter/puskesmas',
                'Surat Keterangan Kelakuan Baik (SKKB)': 'Surat keterangan kelakuan baik dari Polsek',
                'Pas Foto': 'Pas foto 4x6 dengan latar belakang merah',
                'Kartu Keluarga': 'Kartu Keluarga asli/fotokopi'
            };

            if (descriptions[docName]) {
                document.querySelector('textarea[name="keterangan"]').value = descriptions[docName];
            }
        }

        // File preview functionality
        document.getElementById('file_dokumen').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewDiv = document.getElementById('file-preview');
            const previewContent = document.getElementById('preview-content');

            if (file) {
                previewDiv.classList.remove('hidden');

                const fileSize = (file.size / 1024 / 1024).toFixed(2); // Size in MB
                const fileType = file.type;

                previewContent.innerHTML = `
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">${file.name}</p>
                            <p class="text-xs text-gray-500">Ukuran: ${fileSize} MB | Tipe: ${fileType}</p>
                        </div>
                    </div>
                `;

                // Check file size
                if (file.size > 2 * 1024 * 1024) { // 2MB
                    previewContent.innerHTML += `
                        <div class="mt-2 text-xs text-red-600">
                            ⚠️ Ukuran file melebihi 2MB. Silakan kompres file terlebih dahulu.
                        </div>
                    `;
                }
            } else {
                previewDiv.classList.add('hidden');
            }
        });

        // Modal functionality
        document.getElementById('upload-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('upload-modal').style.display = 'none';
            }
        });

        // Reset form when modal closes
        function resetUploadForm() {
            document.querySelector('#upload-modal form').reset();
            document.getElementById('file-preview').classList.add('hidden');
        }

        // Reset form when modal is hidden
        const uploadModal = document.getElementById('upload-modal');
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                    if (uploadModal.style.display === 'none') {
                        resetUploadForm();
                    }
                }
            });
        });
        observer.observe(uploadModal, {
            attributes: true
        });
    </script>
@endsection
