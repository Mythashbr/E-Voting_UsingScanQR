<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    use HasFactory;

    protected $table = 'tb_calon';

    protected $fillable = [
        'name',
        'foto',
        'visi',
        'misi',
        'no_urut',
        'id_pemilihan',
    ];

    public function pemilihan()
    {
        return $this->belongsTo(Pemilihan::class, 'id_pemilihan', 'id');
    }

    public function detailPemilihan()
    {
        return $this->hasMany(DetailPemilihan::class, 'id_calon', 'id');
    }
}
