<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


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
        'id_vendor',
        'id_periode',
        'nama',
        'kuota',
        'lokasi',
        'biaya',
        'level_pelatihan',
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
        return $this->belongsToMany(MataKuliahModel::class, 't_pelatihan_matakuliah', 'id_pelatihan', 'id_matakuliah');
    }

    public function bidangminat(): BelongsToMany
    {
        return $this->belongsToMany(BidangMinatModel::class, 't_pelatihan_bidangminat', 'id_pelatihan', 'id_bidangminat');
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(UserModel::class, 't_detail_pelatihan', 'id_pelatihan', 'id_user');
    }
    public function pelatihanDetails()
    {
        return $this->hasMany(DetailPelatihanModel::class, 'id_pelatihan', 'id_pelatihan');
    }
}
