<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HonorableMention extends Model
{
    protected $fillable = [
        'photo_appreciate_path',
        'nama',
        'mention',
        'story',
        'gallery_path',
    ];
}
