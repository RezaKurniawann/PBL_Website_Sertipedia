<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class PeriodeModel extends Model
{
    use HasFactory;

    protected $table = 'm_periode'; 
    protected $primaryKey = 'id_periode'; 

        /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */

    protected $fillable = [
        'tahun',
        'created_at',
        'updated_at'
    ];

    public function sertifikasi(): HasMany
    {
        return $this->hasMany(SertifikasiModel::class, 'id_periode', 'id_periode');
    }

    public function pelatihan(): HasMany
    {
        return $this->hasMany(PelatihanModel::class, 'id_periode', 'id_periode');
    }
}
