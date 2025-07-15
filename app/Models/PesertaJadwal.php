<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaJadwal extends Model
{
    use HasFactory;

    protected $table = 'peserta_jadwal';

    protected $fillable = [
        'pendaftaran_id',
        'jadwal_id',
        'tanggal_dijadwalkan',
        'dijadwalkan_oleh',
    ];

    protected $casts = [
        'tanggal_dijadwalkan' => 'datetime',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalKeberangkatan::class, 'jadwal_id');
    }

    public function penjadwal()
    {
        return $this->belongsTo(User::class, 'dijadwalkan_oleh');
    }
}
