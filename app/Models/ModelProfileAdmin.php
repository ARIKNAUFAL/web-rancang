<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelProfileAdmin extends Model
{
    use HasFactory;

    public function getProfile($admin_id)
    {
        return DB::table('admin')->leftJoin('profile_admin', 'profile_admin.admin_id', '=', 'admin.id')->where('profile_admin.admin_id', $admin_id)->first();
    }

    public function edit($data)
    {
        DB::table('profile_admin')->where('admin_id', $data['admin_id'])->update($data);
    }

    public function editAdmin($data)
    {
        DB::table('admin')->where('id', $data['id'])->update($data);
    }

    public function detailAdmin($admin_id)
    {
        return DB::table('admin')->where('id', $admin_id)->first();
    }
}
