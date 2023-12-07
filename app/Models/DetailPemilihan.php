<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemilihan extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_pemilihan';

    protected $fillable = [
        'id_pemilihan',
        'id_calon',
        'id_user',
    ];

    public function pemilihan()
    {
        return $this->belongsTo(Pemilihan::class, 'id_pemilihan', 'id');
    }

    public function calon()
    {
        return $this->belongsTo(Calon::class, 'id_calon', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
