<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_id',
        'title'
    ];

    public function period()
    {
        return $this -> belongsTo(Period::class);
    }

    public function subtopics()
    {
        return $this -> hasMany(Subtopic::class);
    }

    public function exams()
    {
        return $this -> hasMany(Exam::class);
    }
}
