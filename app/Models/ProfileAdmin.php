<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileAdmin extends Model
{
    use HasFactory;

    protected $table = 'profile_admin';

    public $timestamps = false;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable =
    [
        'id',
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
