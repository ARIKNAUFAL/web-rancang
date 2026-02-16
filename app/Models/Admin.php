<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';

    public $timestamps = false;

    public $incrementing = false;

    protected $keyType = 'string';

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
        return $this->hasOne(ProfileAdmin::class, 'admin_id', 'id');
    }
}
