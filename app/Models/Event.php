<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'event_date', 'caption', 'poster'];

    protected function casts(): array
    {
        return ['event_date' => 'date'];
    }
}