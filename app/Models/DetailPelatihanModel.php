<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPelatihanModel extends Pivot
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
        'image',
        'surat_tugas',
        'created_at',
        'updated_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }

    public function pelatihan(): BelongsTo
    {
        return $this->belongsTo(PelatihanModel::class, 'id_pelatihan', 'id_pelatihan');
    }
}
