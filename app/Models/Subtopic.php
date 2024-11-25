<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtopic extends Model
{
    use HasFactory;

    protected $fillable =  [
        'lesson_id',
        'subtitle',
        'content',
        'img',
        'example'
    ];

    public function lesson(){
        return $this -> belongsTo(Lesson::class);
    }

}
