<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade',
        'trimester',
    ];

    public function lessons()
    {
        return $this -> hasMany(Lesson::class);
    }

}

