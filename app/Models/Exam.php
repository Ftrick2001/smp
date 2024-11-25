<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'title'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class); // Relación correcta con Lesson
    }

    // Definir la relación con Question (un examen tiene muchas preguntas)
    public function questions()
    {
        return $this->hasMany(Question::class); // Relación correcta
    }

    public function results()
    {
        return $this->hasMany(Result::class); // Relación correcta
    }
}
