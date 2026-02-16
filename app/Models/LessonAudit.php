<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonAudit extends Model
{
    use HasFactory;

    protected $table = 'lesson_audit';

    public $timestamps = false;

    protected $fillable =
    [
        'id',
        'admin_id',
        'audit_action',
        'date',
    ];
}
