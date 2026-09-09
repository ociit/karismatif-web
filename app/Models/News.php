<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'photo_thumbnail_path',
        'tanggal_kejadian',
        'sumber',
        'isPublished'
    ];
}
