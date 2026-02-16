<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Activity extends Controller
{
    public function index()
    {
        $activity = DB::table('lesson_audit')->get();

        $data = [
            'title' => 'Activity',
            'activity' => $activity,
        ];

        return view('activity.activity',$data);
    }
}
