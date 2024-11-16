<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DetailPelatihanModel extends Pivot
{
    use HasFactory;

    protected $table = 't_detail_pelatihan'; 

    protected $primaryKey = ['id_user', 'id_pelatihan'];

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */

    protected $fillable = [
        'id_user',
        'id_pelatihan',
        'status',
        'image',
        'surat_tugas',
        'created_at',
        'updated_at'
    ];
}
