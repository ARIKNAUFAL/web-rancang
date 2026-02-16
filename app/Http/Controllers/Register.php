<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelAuth;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{

    public function __construct()
    {
        $this->ModelAuth = new ModelAuth();
    }

    public function index()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title' => 'Website / User Manager / Register User',
        ];

        return view('admin.register.index', $data);
    }

    public function prosesRegister(Request $request)
    {
        Request()->validate([
            'username'          => 'required|unique:admin,username',
            'email'             => 'required|unique:admin,email|email',
            'password'          => 'min:8|required_with:confirmPassword|same:confirmPassword',
            'confirmPassword'   => 'min:8'
        ]);

        $lastDataAdmin = $this->ModelAuth->lastDataAdmin();
        if ($lastDataAdmin === null) {
            $num = 1;
        } else {
            $num = substr($lastDataAdmin->id, 1, strlen($lastDataAdmin->id));
            $num++;
        }

        if ($num < 10) {
            $admin_id = 'A000' . $num;
        } else if ($num > 9 and $num < 100) {
            $admin_id = 'A00' . $num;
        } else if ($num > 99 and $num < 1000) {
            $admin_id = 'A0' . $num;
        } else {
            $admin_id = 'A' . $num;
        }

        $data = [
            'id'        => $admin_id,
            'username'  => Request()->username,
            'email'     => Request()->email,
            'password'  => Hash::make(Request()->password),
        ];

        $this->ModelAuth->register($data);
        return redirect()->route('register')->with('success', 'Your Account Successfull Created !');
    }
}
