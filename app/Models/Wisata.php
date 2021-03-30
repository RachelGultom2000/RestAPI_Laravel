<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $fillable = [
        'nama_obyek', 'lokasi_obyek', 'akomodasi', 'keterangan'
    ];
}
