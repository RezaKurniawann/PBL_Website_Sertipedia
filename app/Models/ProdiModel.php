<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function kompetensi()
    {
        return $this->hasMany(KompetensiModel::class, 'id_prodi', 'id_prodi');
    }
}
