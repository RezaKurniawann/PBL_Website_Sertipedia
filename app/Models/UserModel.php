<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user'; 
    protected $primaryKey = 'id_user'; 
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'id_level', 
        'id_prodi', 
        'nama', 
        'username', 
        'password', 
        'image',
        'created_at', 
        'updated_at'
    ];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(ProdiModel::class, 'id_prodi', 'id_prodi');
    }

    public function matakuliah()
    {
        return $this->belongsToMany(MataKuliahModel::class, 't_user_matakuliah', 'id_user', 'id_matakuliah');
    }

    public function bidangminat()
    {
        return $this->belongsToMany(BidangMinatModel::class, 't_user_bidangminat', 'id_user', 'id_bidangminat');
    }

    public function pelatihan()
    {
        return $this->belongsToMany(PelatihanModel::class, 't_detail_pelatihan', 'id_user', 'id_pelatihan');
    }

    public function sertifikasi()
    {
        return $this->belongsToMany(SertifikasiModel::class, 't_detail_pelatihan', 'id_user', 'id_sertifikasi');
    }

    public function getRoleName(): string
    {
        return $this->level->nama;
    }

    public function hasRole($role): bool
    {
        return $this->level->kode == $role;
    }

    public function getRole()
    {
        return $this->level->kode;
    }
};
