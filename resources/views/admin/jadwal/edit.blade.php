@extends('layouts.admin')

@section('title', 'Edit Jadwal')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Jadwal Keberangkatan</h1>
                <p class="text-gray-600 mt-1">{{ $jadwal->nama_batch }}</p>
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
                <form method="POST" action="{{ route('admin.jadwal.update', $jadwal) }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="nama_batch" class="block text-sm font-medium text-gray-700 mb-2">Nama Batch
                                *</label>
                            <input type="text" id="nama_batch" name="nama_batch"
                                value="{{ old('nama_batch', $jadwal->nama_batch) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('nama_batch') border-red-500 @enderror">
                            @error('nama_batch')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_keberangkatan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                Keberangkatan *</label>
                            <input type="date" id="tanggal_keberangkatan" name="tanggal_keberangkatan"
                                value="{{ old('tanggal_keberangkatan', $jadwal->tanggal_keberangkatan->format('Y-m-d')) }}"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('tanggal_keberangkatan') border-red-500 @enderror">
                            @error('tanggal_keberangkatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kapasitas" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas Peserta
                                *</label>
                            <input type="number" id="kapasitas" name="kapasitas"
                                value="{{ old('kapasitas', $jadwal->kapasitas) }}" required min="{{ $jadwal->terisi }}"
                                max="100"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('kapasitas') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Minimal {{ $jadwal->terisi }} (jumlah peserta yang sudah
                                terdaftar)</p>
                            @error('kapasitas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select id="status" name="status" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('status') border-red-500 @enderror">
                                <option value="aktif" {{ old('status', $jadwal->status) == 'aktif' ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="penuh" {{ old('status', $jadwal->status) == 'penuh' ? 'selected' : '' }}>
                                    Penuh</option>
                                <option value="selesai"
                                    {{ old('status', $jadwal->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 @error('keterangan') border-red-500 @enderror">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
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
                            Update Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
