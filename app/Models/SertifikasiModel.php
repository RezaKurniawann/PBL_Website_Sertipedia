<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


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
        'id_vendor',
        'id_periode',
        'nama',
        'biaya',
        'jenis_sertifikasi',
        'tanggal_awal',
        'tanggal_akhir',
        'created_at', 
        'updated_at'
    ];

    protected $casts = [
        'tanggal_awal' => 'datetime',
        'tanggal_akhir' => 'datetime',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(VendorModel::class, 'id_vendor', 'id_vendor');
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(PeriodeModel::class, 'id_periode', 'id_periode');
    }

    public function matakuliah(): BelongsToMany
    {
        return $this->belongsToMany(MataKuliahModel::class, 't_sertifikasi_matakuliah', 'id_sertifikasi', 'id_matakuliah');
    }

    public function bidangminat(): BelongsToMany
    {
        return $this->belongsToMany(BidangMinatModel::class, 't_sertifikasi_bidangminat', 'id_sertifikasi', 'id_bidangminat');
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(UserModel::class, 't_detail_sertifikasi', 'id_sertifikasi', 'id_user');
    }
}
