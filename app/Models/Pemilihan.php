<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilihan extends Model
{
    use HasFactory;

    protected $table = 'tb_pemilihan';

    protected $fillable = [
        'name',
        'waktu_mulai',
        'waktu_selesai',
        'status',
    ];

    public function detailPemilihan()
    {
        return $this->hasMany(DetailPemilihan::class, 'id_pemilihan', 'id');
    }

    public function calon()
    {
        return $this->hasMany(Calon::class, 'id_pemilihan', 'id');
    }
}
