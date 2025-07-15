@extends('layouts.admin')

@section('title', 'Buat Jadwal Baru')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Buat Jadwal Keberangkatan</h1>
                <p class="text-gray-600 mt-1">Buat jadwal keberangkatan baru untuk peserta</p>
            </div>
            <a href="{{ route('admin.jadwal.index') }}"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                Kembali
            </a>
        </div>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <form method="POST" action="{{ route('admin.jadwal.store') }}">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="nama_batch" class="block text-sm font-medium text-gray-700 mb-2">Nama Batch
                                *</label>
                            <input type="text" id="nama_batch" name="nama_batch" value="{{ old('nama_batch') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('nama_batch') border-red-500 @enderror"
                                placeholder="Contoh: Batch A - Tokyo 2025">
                            @error('nama_batch')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_keberangkatan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                Keberangkatan *</label>
                            <input type="date" id="tanggal_keberangkatan" name="tanggal_keberangkatan"
                                value="{{ old('tanggal_keberangkatan') }}" required
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('tanggal_keberangkatan') border-red-500 @enderror">
                            @error('tanggal_keberangkatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kapasitas" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Peserta
                                *</label>
                            <input type="number" id="kapasitas" name="kapasitas" value="{{ old('kapasitas') }}" required
                                min="1" max="100"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('kapasitas') border-red-500 @enderror"
                                placeholder="Jumlah maksimal peserta">
                            @error('kapasitas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('keterangan') border-red-500 @enderror"
                                placeholder="Deskripsi program, lokasi kerja, bidang pekerjaan, dll...">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.jadwal.index') }}"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Buat Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
