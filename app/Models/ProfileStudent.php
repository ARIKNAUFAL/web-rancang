<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileStudent extends Model
{
    use HasFactory;

    protected $table = 'profile_student';

    public $primaryKey = 'student_id';

    public $timestamps = false;

    protected $fillable =
    [
        'student_id',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'gender',
        'photo_profile'
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
