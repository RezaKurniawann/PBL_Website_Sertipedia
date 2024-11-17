<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProdiModel extends Model
{   
    use HasFactory;

    protected $table = 't_prodi'; 
    protected $primaryKey = 'id_prodi'; 

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

    public function user(): HasMany
    {
        return $this->hasMany(UserModel::class, 'id_prodi', 'id_prodi');
    }

    public function kompetensi(): HasMany
    {
        return $this->hasMany(KompetensiModel::class, 'id_prodi', 'id_prodi');
    }

    public function matakuliah(): BelongsToMany
    {
        return $this->belongsToMany(MataKuliahModel::class, 't_prodi_matakuliah', 'id_prodi', 'id_matakuliah');
    }
}
