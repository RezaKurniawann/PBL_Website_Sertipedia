<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level';

    protected $primaryKey = 'id_level';

        /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */

    protected $fillable = [
        'kode', 'nama', 
        'created_at', 
        'updated_at'
    ];

    public function user(): HasMany
    {
        return $this->hasMany(UserModel::class, 'id_level', 'id_level');
    }
}