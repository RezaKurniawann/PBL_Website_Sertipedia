<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PangkatModel extends Model
{
    use HasFactory;

    protected $table = 'm_pangkat';

    protected $primaryKey = 'id_pangkat';

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
        return $this->hasMany(UserModel::class, 'id_pangkat', 'id_pangkat');
    }
}
