<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user'; // mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'id_user'; //mendefinisikan primary key dari tabel yang digunakan
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    // protected $fillable = ['level_id', 'username', 'nama', 'password'];
    protected $fillable = ['id_level', 'id_prodi', 'nama', 'username', 'password', 'image','created_at', 'updated_at'];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
    }
    
    //  Mendapatkan nama role
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
