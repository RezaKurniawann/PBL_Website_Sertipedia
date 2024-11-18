<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VendorModel extends Model
{
    use HasFactory;

    protected $table = 'm_vendor'; 
    protected $primaryKey = 'id_vendor';
    
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */

    protected $fillable = [
        'nama', 
        'alamat', 
        'kota', 
        'telepon', 
        'alamatWeb', 
        'kategori', 
        'created_at', 
        'updated_at'
    ];

    public function sertifikasi(): HasMany
    {
        return $this->hasMany(SertifikasiModel::class, 'id_vendor', 'id_vendor');
    }

    public function pelatihan(): HasMany
    {
        return $this->hasMany(PelatihanModel::class, 'id_vendor', 'id_vendor');
    }
}
