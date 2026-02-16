<?php

namespace App\Http\Controllers;

use App\Models\CourseSuggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RequestAdmin extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Website / Request Manager',
            'requests' => CourseSuggestion::all()
        ];

        return view('admin.request.index', $data);
    }

    public function respond(CourseSuggestion $data)
    {
        $data->admin_id = Session::get('admin_id');
        $data->status = 'Responded';
        $data->save();

        return redirect()->route('admin.request.index');
    }

    public function decline(CourseSuggestion $data)
    {
        $data->admin_id = Session::get('admin_id');
        $data->status = 'Declined';
        $data->save();

        return redirect()->route('admin.request.index');
    }
}
