<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SertifikasiModel extends Model
{
    use HasFactory;

    protected $table = 'm_sertifikasi';
    protected $primaryKey = 'id_sertifikasi';

        /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */

    protected $fillable = [
        'id_matakuliah',
        'id_bidangminat',
        'id_vendor',
        'id_periode',
        'nama',
        'biaya',
        'jenis_sertifikasi',
        'tanggal_awal',
        'tanggal_akhir',
        'masa_berlaku', 
        'created_at', 
        'updated_at'
    ];

    protected $casts = [
        'tanggal_awal' => 'datetime',
        'tanggal_akhir' => 'datetime',
    ];

    public function matakuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliahModel::class, 'id_matakuliah', 'id_matakuliah');
    }

    public function bidangMinat(): BelongsTo
    {
        return $this->belongsTo(BidangMinatModel::class, 'id_bidangminat', 'id_bidangminat');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(VendorModel::class, 'id_vendor', 'id_vendor');
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(PeriodeModel::class, 'id_periode', 'id_periode');
    }

    public function detailsertifikasi(): HasMany
    {
        return $this->hasMany(DetailSertifikasiModel::class, 'id_sertifikasi', 'id_sertifikasi');
    }
}
