<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class score extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id', 'mata_pelajran', 'nilai'
    ];
}
