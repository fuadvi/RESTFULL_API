<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', "alamat", "no_telp"
    ];
    protected $guard = [];

    public function score()
    {
        return $this->HasMany(score::class, 'student_id');
    }
}
