<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GolonganModel extends Model
{
    use HasFactory;
    protected $table = 'm_golongan';

    protected $primaryKey = 'id_golongan';

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
        return $this->hasMany(UserModel::class, 'id_golongan', 'id_golongan');
    }
}
