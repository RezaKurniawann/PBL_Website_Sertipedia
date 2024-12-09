<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_level', 
        'nama', 
        'email', 
        'password', 
        'image', 
        'created_at', 
        'updated_at'];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
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
}
