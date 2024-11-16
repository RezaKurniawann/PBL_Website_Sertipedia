<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DetailSertifikasiModel extends Pivot
{
    use HasFactory;

    protected $table = 't_detail_sertifikasi'; 

    protected $primaryKey = ['id_user', 'id_sertifikasi'];

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

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }

    public function sertifikasi()
    {
        return $this->belongsTo(SertifikasiModel::class, 'id_sertifikasi', 'id_sertifikasi');
    }
}
