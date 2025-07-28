<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'user_id',
        'nomor_pendaftaran',
        'status',
        'catatan',
        'tanggal_verifikasi',
        'diverifikasi_oleh',
        'prioritas',  // Tambahan kolom prioritas
    ];

    protected $casts = [
        'tanggal_verifikasi' => 'datetime',
        'prioritas' => 'decimal:2',  // Cast prioritas sebagai decimal
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class);
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }

    public function jadwal()
    {
        return $this->hasOne(PesertaJadwal::class);
    }

    public function generateNomorPendaftaran()
    {
        $tahun = date('Y');
        $bulan = date('m');
        $urutan = static::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->count() + 1;

        return "LPK{$tahun}{$bulan}" . str_pad($urutan, 4, '0', STR_PAD_LEFT);
    }
}
