<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKeberangkatan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_keberangkatan';

    protected $fillable = [
        'nama_batch',
        'tanggal_keberangkatan',
        'kapasitas',
        'terisi',
        'keterangan',
        'status',
    ];

    protected $casts = [
        'tanggal_keberangkatan' => 'date',
    ];

    public function peserta()
    {
        return $this->hasMany(PesertaJadwal::class, 'jadwal_id');
    }

    public function isFull()
    {
        return $this->terisi >= $this->kapasitas;
    }

    public function sisaKapasitas()
    {
        return $this->kapasitas - $this->terisi;
    }
}
