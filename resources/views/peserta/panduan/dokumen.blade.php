@extends('layouts.peserta')

@section('title', 'Persyaratan Dokumen')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Persyaratan Dokumen</h1>
        <p class="text-gray-600 mt-1">Panduan lengkap dokumen yang diperlukan untuk pendaftaran LPK Jepang</p>
    </div>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 mb-6 text-white">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold">Persiapkan Dokumen Anda</h3>
                <p class="text-green-100 mt-1">Pastikan semua dokumen sesuai dengan persyaratan untuk mempercepat proses
                    verifikasi</p>
            </div>
        </div>
    </div>

    <!-- Document Categories -->
    <div class="space-y-8">
        <!-- Dokumen Wajib -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Dokumen Wajib</h3>
                        <p class="text-sm text-gray-600">Dokumen yang harus dilengkapi untuk proses verifikasi</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- KTP -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">KTP (Kartu Tanda Penduduk)</h4>
                                <ul class="text-sm text-gray-600 space-y-1 mb-3">
                                    <li>• KTP asli yang masih berlaku</li>
                                    <li>• Foto harus jelas dan tidak buram</li>
                                    <li>• Pastikan semua informasi terbaca dengan baik</li>
                                    <li>• Format: PDF atau JPG/PNG</li>
                                </ul>
                                <div class="flex items-center text-xs">
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full mr-2">Wajib</span>
                                    <span class="text-gray-500">Berlaku minimal 6 bulan ke depan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ijazah -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">Ijazah Pendidikan Terakhir</h4>
                                <ul class="text-sm text-gray-600 space-y-1 mb-3">
                                    <li>• Ijazah asli atau fotokopi yang dilegalisir</li>
                                    <li>• SMP, SMA/SMK, D3, atau S1</li>
                                    <li>• Scan dengan resolusi tinggi</li>
                                    <li>• Pastikan stempel dan tanda tangan jelas</li>
                                </ul>
                                <div class="flex items-center text-xs">
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full mr-2">Wajib</span>
                                    <span class="text-gray-500">Minimal SMP sederajat</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transkrip Nilai -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">Transkrip Nilai</h4>
                                <ul class="text-sm text-gray-600 space-y-1 mb-3">
                                    <li>• Transkrip nilai pendidikan terakhir</li>
                                    <li>• Asli atau fotokopi yang dilegalisir</li>
                                    <li>• Mencantumkan semua mata pelajaran/kuliah</li>
                                    <li>• Stempel sekolah/universitas harus jelas</li>
                                </ul>
                                <div class="flex items-center text-xs">
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full mr-2">Wajib</span>
                                    <span class="text-gray-500">Sesuai dengan ijazah</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Surat Keterangan Sehat -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">Surat Keterangan Sehat</h4>
                                <ul class="text-sm text-gray-600 space-y-1 mb-3">
                                    <li>• Dari dokter umum, puskesmas, atau rumah sakit</li>
                                    <li>• Berlaku maksimal 3 bulan dari tanggal pemeriksaan</li>
                                    <li>• Mencakup pemeriksaan fisik dan mental</li>
                                    <li>• Kop surat dan stempel institusi kesehatan</li>
                                </ul>
                                <div class="flex items-center text-xs">
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full mr-2">Wajib</span>
                                    <span class="text-gray-500">Maksimal 3 bulan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SKKB -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">Surat Keterangan Kelakuan Baik (SKKB)</h4>
                                <ul class="text-sm text-gray-600 space-y-1 mb-3">
                                    <li>• Dari Polsek sesuai domisili KTP</li>
                                    <li>• Berlaku maksimal 6 bulan</li>
                                    <li>• Menyatakan tidak pernah terlibat tindak pidana</li>
                                    <li>• Stempel dan tanda tangan petugas berwenang</li>
                                </ul>
                                <div class="flex items-center text-xs">
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full mr-2">Wajib</span>
                                    <span class="text-gray-500">Maksimal 6 bulan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pas Foto -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">Pas Foto</h4>
                                <ul class="text-sm text-gray-600 space-y-1 mb-3">
                                    <li>• Ukuran 4x6 cm dengan latar belakang merah</li>
                                    <li>• Foto terbaru (maksimal 6 bulan)</li>
                                    <li>• Berpakaian rapi dan sopan</li>
                                    <li>• Wajah terlihat jelas, tidak pakai kacamata hitam</li>
                                </ul>
                                <div class="flex items-center text-xs">
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full mr-2">Wajib</span>
                                    <span class="text-gray-500">Latar belakang merah</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu Keluarga -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">Kartu Keluarga</h4>
                                <ul class="text-sm text-gray-600 space-y-1 mb-3">
                                    <li>• Kartu Keluarga asli atau fotokopi</li>
                                    <li>• Data sesuai dengan KTP</li>
                                    <li>• Scan dengan kualitas tinggi</li>
                                    <li>• Semua informasi harus terbaca jelas</li>
                                </ul>
                                <div class="flex items-center text-xs">
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full mr-2">Wajib</span>
                                    <span class="text-gray-500">Sesuai dengan KTP</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dokumen Opsional -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Dokumen Opsional (Nilai Tambah)</h3>
                        <p class="text-sm text-gray-600">Dokumen pendukung yang dapat meningkatkan peluang diterima</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Sertifikat Keterampilan -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">Sertifikat Keterampilan</h4>
                                <ul class="text-sm text-gray-600 space-y-1 mb-3">
                                    <li>• Sertifikat kursus/pelatihan teknis</li>
                                    <li>• Sertifikat bahasa (Jepang/Inggris)</li>
                                    <li>• Sertifikat keahlian khusus</li>
                                    <li>• Sertifikat profesi yang relevan</li>
                                </ul>
                                <div class="flex items-center text-xs">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full mr-2">Opsional</span>
                                    <span class="text-gray-500">Meningkatkan peluang</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pengalaman Kerja -->
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">Surat Pengalaman Kerja</h4>
                                <ul class="text-sm text-gray-600 space-y-1 mb-3">
                                    <li>• Surat keterangan dari mantan perusahaan</li>
                                    <li>• CV atau resume terkini</li>
                                    <li>• Portofolio pekerjaan (jika ada)</li>
                                    <li>• Referensi dari atasan/kolega</li>
                                </ul>
                                <div class="flex items-center text-xs">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full mr-2">Opsional</span>
                                    <span class="text-gray-500">Pengalaman industri</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips & Panduan -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Tips & Panduan Upload Dokumen</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Yang Harus Dilakukan
                        </h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Scan dokumen dengan resolusi minimal 300 DPI
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Pastikan semua teks dapat dibaca dengan jelas
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Gunakan format PDF untuk dokumen resmi
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Kompres file jika ukuran lebih dari 2MB
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Periksa kembali sebelum upload
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Yang Harus Dihindari
                        </h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Jangan upload foto dokumen yang buram atau gelap
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Hindari dokumen yang terpotong atau tidak lengkap
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Jangan upload dokumen yang sudah kedaluwarsa
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Hindari format file selain PDF, JPG, atau PNG
                            </li>
                            <li class="flex items-start">
                                <span class="w-2 h-2 bg-red-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Jangan upload file yang rusak atau tidak bisa dibuka
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Technical Requirements -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-semibold text-gray-900 mb-3">Persyaratan Teknis File</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                        <div class="text-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <p class="font-medium text-gray-900">Format</p>
                            <p class="text-gray-600">PDF, JPG, PNG</p>
                        </div>
                        <div class="text-center">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4">
                                    </path>
                                </svg>
                            </div>
                            <p class="font-medium text-gray-900">Ukuran File</p>
                            <p class="text-gray-600">Maksimal 2MB</p>
                        </div>
                        <div class="text-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <p class="font-medium text-gray-900">Resolusi</p>
                            <p class="text-gray-600">Minimal 300 DPI</p>
                        </div>
                        <div class="text-center">
                            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="font-medium text-gray-900">Kualitas</p>
                            <p class="text-gray-600">Jelas & Terbaca</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
