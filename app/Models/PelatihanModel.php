<?php

namespace App\Models;

use App\Http\Controllers\DetailPelatihanController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PelatihanModel extends Model
{
    use HasFactory;

    protected $table = 'm_pelatihan';
    protected $primaryKey = 'id_pelatihan';

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
        'kuota',
        'lokasi',
        'biaya',
        'level_pelatihan',
        'tanggal_awal',
        'tanggal_akhir',
        'waktu_pelatihan',
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

    public function detailpelatihan(): HasMany
    {
        return $this->hasMany(DetailPelatihanModel::class, 'id_pelatihan', 'id_pelatihan');
    }
}
