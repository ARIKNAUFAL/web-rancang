<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelAuth extends Model
{
    use HasFactory;

    public function login($username)
    {
        return DB::table('admin')->where('username', $username)->first();
    }

    public function detailAdmin($admin_id)
    {
        return DB::table('profile_admin')->where('admin_id', $admin_id)->first();
    }

    public function register($data)
    {
        DB::table('admin')->insert($data);
    }

    public function lastDataAdmin()
    {
        return DB::table('admin')->orderBy('id', 'DESC')->limit(1)->first();
    }

    public function loginStudent($username)
    {
        return DB::table('student')->where('username', $username)->first();
    }

    public function detailStudent($student_id)
    {
        return DB::table('profile_student')->where('student_id', $student_id)->first();
    }
}
