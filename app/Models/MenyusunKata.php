<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenyusunKata extends Model
{
    use HasFactory;
    protected $fillable = ['soal', 'jawaban', 'gambar'];
}
