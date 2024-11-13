<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BidangMinatModel extends Model
{
    use HasFactory;

    protected $table = 'm_bidangminat'; 
    protected $primaryKey = 'id_bidangminat'; 

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */

    protected $fillable = [
        'kode',
        'nama',
        'created_at',
        'updated_at'
    ];

    public function sertifikasi(): HasMany
    {
        return $this->hasMany(SertifikasiModel::class, 'id_bidangminat', 'id_bidangminat');
    }

    public function pelatihan(): HasMany
    {
        return $this->hasMany(PelatihanModel::class, 'id_bidangminat', 'id_bidangminat');
    }

}
