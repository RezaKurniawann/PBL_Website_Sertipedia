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
        'id_matakuliah',
        'id_bidangminat',
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

    public function matakuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliahModel::class, 'id_matakuliah', 'id_matakuliah');
    }

    public function bidangminat(): BelongsTo
    {
        return $this->belongsTo(BidangMinatModel::class, 'id_bidangminat', 'id_bidangminat');
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(ProdiModel::class, 'id_prodi', 'id_prodi');
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
