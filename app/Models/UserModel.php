<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory;

    public function getJWTIdentifier() {
        return $this -> getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    protected $table = 'm_user'; 
    protected $primaryKey = 'id_user'; 
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'id_level', 
        'id_prodi', 
        'id_pangkat', 
        'id_golongan', 
        'id_jabatan', 
        'nama', 
        'email',
        'no_telp',
        'username', 
        'password', 
        'image',
        'created_at', 
        'updated_at'
    ];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(ProdiModel::class, 'id_prodi', 'id_prodi');
    }

    public function pangkat(): BelongsTo
    {
        return $this->belongsTo(PangkatModel::class, 'id_pangkat', 'id_pangkat');
    }

    public function golongan(): BelongsTo
    {
        return $this->belongsTo(GolonganModel::class, 'id_golongan', 'id_golongan');
    }

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(JabatanModel::class, 'id_jabatan', 'id_jabatan');
    }

    public function matakuliah(): BelongsToMany
    {
        return $this->belongsToMany(MataKuliahModel::class, 't_user_matakuliah', 'id_user', 'id_matakuliah');
    }

    public function bidangminat(): BelongsToMany
    {
        return $this->belongsToMany(BidangMinatModel::class, 't_user_bidangminat', 'id_user', 'id_bidangminat');
    }

    public function pelatihan(): BelongsToMany
    {
        return $this->belongsToMany(PelatihanModel::class, 't_detail_pelatihan', 'id_user', 'id_pelatihan');
    }

    public function sertifikasi(): BelongsToMany
    {
        return $this->belongsToMany(SertifikasiModel::class, 't_detail_sertifikasi', 'id_user', 'id_sertifikasi');
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

    public function image() {

        return Attribute::make (
            get :fn ($image) => url ('/storage/posts/' . $image),
        );
    }

    public function pelatihanDetails()
    {
        return $this->hasMany(DetailPelatihanModel::class, 'id_user', 'id_user');
    }

    public function sertifikasiDetails()
    {
        return $this->hasMany(DetailSertifikasiModel::class, 'id_user', 'id_user');
    }

};
