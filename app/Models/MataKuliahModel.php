<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MataKuliahModel extends Model
{
    use HasFactory;

    protected $table = 'm_matakuliah';
    protected $primaryKey = 'id_matakuliah'; 

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

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(UserModel::class, 't_user_matakuliah', 'id_matakuliah', 'id_user');
    }

    public function prodi(): BelongsToMany
    {
        return $this->belongsToMany(ProdiModel::class, 't_prodi_matakuliah', 'id_matakuliah', 'id_prodi');
    }

    public function pelatihan(): BelongsToMany
    {
        return $this->belongsToMany(PelatihanModel::class, 't_pelatihan_matakuliah', 'id_matakuliah', 'id_pelatihan');
    }

    public function sertifikasi(): BelongsToMany
    {
        return $this->belongsToMany(SertifikasiModel::class, 't_sertifikasi_matakuliah', 'id_matakuliah', 'id_sertifikasi');
    }


}
