<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbjadAlfabet extends Model
{
    use HasFactory;
    protected $fillable = ['alfabet'];  
    protected $casts = [
        'alfabet' => 'array',
    ];
}
