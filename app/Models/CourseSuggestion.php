<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSuggestion extends Model
{
    use HasFactory;

    protected $table = 'course_suggestion';

    public $timestamps = false;

    protected $fillable =
    [
        'id',
        'student_id',
        'admin_id',
        'topic',
        'message',
        'status',
        'date',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }
}
