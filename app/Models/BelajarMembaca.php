<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BelajarMembaca extends Model
{
    use HasFactory;
    protected $fillable = ['konten'];
    protected $casts = [
        'konten' => 'array',
    ];
}
