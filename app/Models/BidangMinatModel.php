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
        'nama',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsToMany(UserModel::class, 't_user_bidangminat', 'id_bidangminat', 'id_user');
    }

    public function pelatihan()
    {
        return $this->belongsToMany(PelatihanModel::class, 't_pelatihan_bidangminat', 'id_bidangminat', 'id_pelatihan');
    }

    public function sertifikasi()
    {
        return $this->belongsToMany(SertifikasiModel::class, 't_sertifikasi_bidangminat', 'id_bidangminat', 'id_sertifikasi');
    }

}
