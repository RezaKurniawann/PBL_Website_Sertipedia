<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailSertifikasiModel extends Model
{
    use HasFactory;

    protected $table = 't_detail_sertifikasi'; 
    protected $primaryKey = 'id_detail_sertifikasi'; 

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */

    protected $fillable = [
        'id_user',
        'id_sertifikasi',
        'status',
        'no_sertifikasi',
        'image',
        'surat_tugas',
        'created_at',
        'updated_at'
    ];

    public function sertifikasi(): HasMany
    {
        return $this->hasMany(SertifikasiModel::class, 'id_detail_sertifikasi', 'id_detail_sertifikasi');
    }
}
