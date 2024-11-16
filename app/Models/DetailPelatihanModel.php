<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailPelatihanModel extends Model
{
    use HasFactory;

    protected $table = 't_detail_pelatihan'; 
    protected $primaryKey = 'id_detail_pelatihan'; 

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */

    protected $fillable = [
        'id_user',
        'id_pelatihan',
        'status',
        'no_pelatihan',
        'image',
        'surat_tugas',
        'created_at',
        'updated_at'
    ];

    public function pelatihan(): HasMany
    {
        return $this->hasMany(pelatihanModel::class, 'id_detail_pelatihan', 'id_detail_pelatihan');
    }
}
