<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyLearning extends Model
{
    use HasFactory;

    protected $table = 'class';

    public $timestamps = false;

    public function lesson()
    {
        return $this->hasOne(Lesson::class, 'id', 'lesson_id');
    }
}
