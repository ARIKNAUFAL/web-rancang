<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    public $timestamps = false;

    protected $fillable =
    [
        'id',
        'username',
        'password',
        'email',
        'status',
    ];

    public function profile()
    {
        return $this->hasOne(ProfileStudent::class, 'student_id', 'id');
    }
}
