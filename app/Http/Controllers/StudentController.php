<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel 'student'
        $students = DB::table('student')->get();

        // Kirim data ke view
        $data = [
            'title' => 'Student Data',
            'students' => $students,
        ];

        return view('student.index', $data);
    }
}
