@extends('layouts.peserta')

@section('title', 'Pendaftaran LPK Jepang')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Pendaftaran Program LPK Jepang</h1>
        <p class="text-gray-600 mt-1">Daftar untuk mengikuti program pelatihan kerja ke Jepang</p>
    </div>

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

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-8 mb-8 text-white">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                    </path>
                </svg>
            </div>
            <div class="ml-6">
                <h2 class="text-3xl font-bold mb-2">Program LPK Jepang</h2>
                <p class="text-green-100 text-lg">Wujudkan impian bekerja di Jepang dengan program pelatihan kerja
                    terpercaya</p>
                <div class="mt-4 flex flex-wrap gap-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm">Program 3 Tahun</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm">Gaji Kompetitif</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm">Bimbingan Bahasa</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Check Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Periksa Data Profil Anda</h3>
            <p class="text-sm text-gray-600 mt-1">Pastikan data profil sudah lengkap sebelum mendaftar</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $user = auth()->user();
                    $profileFields = [
                        ['label' => 'Nama Lengkap', 'value' => $user->nama, 'required' => true],
                        ['label' => 'Email', 'value' => $user->email, 'required' => true],
                        ['label' => 'No. Telepon', 'value' => $user->no_telepon, 'required' => true],
                        ['label' => 'Tanggal Lahir', 'value' => $user->tanggal_lahir, 'required' => true],
                        ['label' => 'Alamat', 'value' => $user->alamat, 'required' => true],
                        ['label' => 'Pendidikan Terakhir', 'value' => $user->pendidikan_terakhir, 'required' => true],
                    ];

                    $isProfileComplete = true;
                    foreach ($profileFields as $field) {
                        if ($field['required'] && empty($field['value'])) {
                            $isProfileComplete = false;
                            break;
                        }
                    }
                @endphp

                @foreach ($profileFields as $field)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $field['label'] }}</p>
                            <p class="text-sm text-gray-600">
                                @if ($field['value'])
                                    @if ($field['label'] == 'Tanggal Lahir' && $field['value'])
                                        {{ \Carbon\Carbon::parse($field['value'])->format('d M Y') }}
                                    @else
                                        {{ $field['value'] }}
                                    @endif
                                @else
                                    <span class="text-red-500">Belum diisi</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            @if ($field['value'])
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if (!$isProfileComplete)
                <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-yellow-800">Data Profil Belum Lengkap</h4>
                            <p class="mt-1 text-sm text-yellow-700">
                                Harap lengkapi data profil Anda terlebih dahulu sebelum melakukan pendaftaran.
                            </p>
                            <div class="mt-3">
                                <a href="{{ route('peserta.profil.edit') }}"
                                    class="inline-flex items-center px-3 py-2 bg-yellow-600 text-white text-sm rounded-md hover:bg-yellow-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Lengkapi Profil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Program Information -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Benefits -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Keunggulan Program</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Gaji Kompetitif</h4>
                            <p class="text-sm text-gray-600">Gaji sesuai standar minimum Jepang dengan bonus overtime</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Pelatihan Bahasa</h4>
                            <p class="text-sm text-gray-600">Bimbingan bahasa Jepang intensif sebelum keberangkatan</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Legal & Aman</h4>
                            <p class="text-sm text-gray-600">Program resmi dengan izin lengkap dari pemerintah</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3 mt-1">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Berbagai Lokasi</h4>
                            <p class="text-sm text-gray-600">Penempatan di Tokyo, Osaka, Nagoya, dan kota lainnya</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Requirements -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Persyaratan Program</h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-700">Usia 18-35 tahun</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-700">Pendidikan minimal SMP</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-700">Sehat jasmani dan rohani</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-700">Tidak memiliki catatan kriminal</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-700">Siap mengikuti pelatihan</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-700">Komitmen kontrak 3 tahun</span>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex">
                        <svg class="w-5 h-5 text-blue-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-blue-800">Catatan Penting</h4>
                            <p class="mt-1 text-sm text-blue-700">
                                Setelah mendaftar, Anda akan mendapatkan nomor pendaftaran dan panduan upload dokumen.
                                Proses verifikasi membutuhkan waktu 3-7 hari kerja.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Form Pendaftaran</h3>
            <p class="text-sm text-gray-600 mt-1">Pastikan Anda memahami dan setuju dengan persyaratan program</p>
        </div>
        <div class="p-6">
            @if ($isProfileComplete)
                <form method="POST" action="{{ route('peserta.pendaftaran.store') }}" class="space-y-6">
                    @csrf

                    <!-- Terms and Conditions -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Syarat dan Ketentuan</h4>
                        <div class="max-h-60 overflow-y-auto text-sm text-gray-700 space-y-3 mb-4">
                            <p><strong>1. Komitmen Program:</strong> Peserta bersedia mengikuti program pelatihan kerja
                                selama 3 tahun di Jepang sesuai dengan penempatan yang diberikan.</p>

                            <p><strong>2. Biaya Program:</strong> Peserta memahami struktur biaya program termasuk biaya
                                pelatihan, administrasi, dan pengurusan dokumen yang akan dijelaskan lebih detail setelah
                                lulus seleksi.</p>

                            <p><strong>3. Proses Seleksi:</strong> Peserta bersedia mengikuti seluruh tahapan seleksi yang
                                meliputi verifikasi dokumen, tes kesehatan, tes bahasa, dan wawancara.</p>

                            <p><strong>4. Pelatihan Bahasa:</strong> Peserta wajib mengikuti pelatihan bahasa Jepang yang
                                diselenggarakan oleh LPK hingga mencapai level yang ditentukan.</p>

                            <p><strong>5. Kontrak Kerja:</strong> Peserta memahami bahwa kontrak kerja akan dibuat sesuai
                                dengan aturan pemerintah Jepang dan perusahaan penerima.</p>

                            <p><strong>6. Kedisiplinan:</strong> Peserta bersedia mentaati semua peraturan yang berlaku di
                                LPK maupun di tempat kerja di Jepang.</p>

                            <p><strong>7. Pembatalan:</strong> Jika peserta mengundurkan diri setelah lulus seleksi, maka
                                peserta bertanggung jawab atas biaya yang telah dikeluarkan sesuai dengan ketentuan yang
                                berlaku.</p>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="agree" required
                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <span class="ml-2 text-sm text-gray-700">
                                    Saya telah membaca, memahami, dan <strong>setuju</strong> dengan seluruh syarat dan
                                    ketentuan program LPK Jepang
                                </span>
                            </label>
                            @error('agree')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-between">
                        <a href="{{ route('peserta.dashboard') }}"
                            class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                            Kembali
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Data Profil Belum Lengkap</h3>
                    <p class="text-gray-600 mb-6">Silakan lengkapi data profil Anda terlebih dahulu sebelum melakukan
                        pendaftaran program LPK Jepang.</p>

                    <div class="space-y-3">
                        <a href="{{ route('peserta.profil.edit') }}"
                            class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Lengkapi Profil Sekarang
                        </a>

                        <div>
                            <a href="{{ route('peserta.dashboard') }}"
                                class="text-gray-600 hover:text-gray-800 text-sm underline">
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Pertanyaan Umum</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="border border-gray-200 rounded-lg">
                    <button
                        class="w-full px-4 py-3 text-left font-medium text-gray-900 bg-gray-50 hover:bg-gray-100 rounded-t-lg"
                        onclick="toggleFaq(1)">
                        Berapa lama proses seleksi hingga keberangkatan?
                        <svg class="w-5 h-5 float-right mt-0.5 transform transition-transform" id="faq-icon-1"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div class="px-4 py-3 text-sm text-gray-700 hidden" id="faq-content-1">
                        Proses seleksi hingga keberangkatan biasanya memakan waktu 6-12 bulan, tergantung pada kelengkapan
                        dokumen, hasil tes, dan ketersediaan kuota dari perusahaan di Jepang.
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg">
                    <button
                        class="w-full px-4 py-3 text-left font-medium text-gray-900 bg-gray-50 hover:bg-gray-100 rounded-t-lg"
                        onclick="toggleFaq(2)">
                        Apakah ada biaya pendaftaran?
                        <svg class="w-5 h-5 float-right mt-0.5 transform transition-transform" id="faq-icon-2"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div class="px-4 py-3 text-sm text-gray-700 hidden" id="faq-content-2">
                        Pendaftaran awal tidak dikenakan biaya. Biaya program akan dijelaskan secara detail setelah Anda
                        lulus tahap seleksi awal dan akan disesuaikan dengan program yang dipilih.
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg">
                    <button
                        class="w-full px-4 py-3 text-left font-medium text-gray-900 bg-gray-50 hover:bg-gray-100 rounded-t-lg"
                        onclick="toggleFaq(3)">
                        Bidang pekerjaan apa saja yang tersedia?
                        <svg class="w-5 h-5 float-right mt-0.5 transform transition-transform" id="faq-icon-3"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div class="px-4 py-3 text-sm text-gray-700 hidden" id="faq-content-3">
                        Bidang pekerjaan meliputi manufaktur, konstruksi, pertanian, perikanan, makanan dan minuman,
                        tekstil, dan bidang lainnya sesuai dengan kebutuhan perusahaan di Jepang.
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg">
                    <button
                        class="w-full px-4 py-3 text-left font-medium text-gray-900 bg-gray-50 hover:bg-gray-100 rounded-t-lg"
                        onclick="toggleFaq(4)">
                        Apakah bisa memilih lokasi penempatan?
                        <svg class="w-5 h-5 float-right mt-0.5 transform transition-transform" id="faq-icon-4"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div class="px-4 py-3 text-sm text-gray-700 hidden" id="faq-content-4">
                        Penempatan akan disesuaikan dengan ketersediaan lowongan dan kualifikasi peserta. Kami akan berusaha
                        mengakomodasi preferensi, namun keputusan akhir tergantung pada kebutuhan perusahaan penerima.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFaq(index) {
            const content = document.getElementById(`faq-content-${index}`);
            const icon = document.getElementById(`faq-icon-${index}`);

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }
    </script>
@endsection
