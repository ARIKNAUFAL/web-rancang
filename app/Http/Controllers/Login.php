<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelAuth;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{

    public function __construct()
    {
        $this->ModelAuth = new ModelAuth();
    }

    public function index()
    {
        if (Session()->get('email')) {
            return redirect()->route('dashboard');
        }

        $data = [
            'title' => 'Login',
        ];

        return view('login.index', $data);
    }

    public function prosesLogin()
    {
        Request()->validate([
            'username'  => 'required',
            'password'  => 'required|min:8'
        ]);

        $cekLogin = $this->ModelAuth->login(Request()->username);

        if ($cekLogin) {
            if ($this->verifyAndUpgradePassword('admin', 'id', $cekLogin->id, Request()->password, $cekLogin->password)) {
                if ($cekLogin->status === 'Active') {
                    $detailAdmin = $this->ModelAuth->detailAdmin($cekLogin->id);

                    Session()->put('admin_id', $detailAdmin->admin_id);
                    Session()->put('fullname', $detailAdmin->first_name . ' ' . $detailAdmin->last_name);
                    Session()->put('photo_profile', $detailAdmin->photo_profile);
                    Session()->put('email', $cekLogin->email);
                    Session()->put('status', $cekLogin->status);
                    Session()->put('log', true);

                    return redirect()->route('dashboard');
                } else {
                    return back()->with('error', 'Login Failed!! Your account is non-active.');
                }
            } else {
                return back()->with('error', 'Your Username Or Password incorrect.');
            }
        } else {
            return back()->with('error', 'Your Username Or Password incorrect.');
        }
    }

    public function logout()
    {
        Session()->forget('admin_id');
        Session()->forget('fullname');
        Session()->forget('photo_profile');
        Session()->forget('email');
        Session()->forget('status');
        Session()->forget('log');
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }

    public function prosesRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:student,username',
            'password' => 'required|min:8',
            'email' => 'required|unique:student,email'
        ]);

        $student = new Student();
        $student->username = $request->username;
        $student->password = Hash::make($request->password);
        $student->email = $request->email;
        $student->save();

        return redirect()->route('index');
    }

    public function prosesLoginStudent()
    {
        Request()->validate([
            'username'  => 'required',
            'password'  => 'required|min:8'
        ]);

        $cekLogin = $this->ModelAuth->loginStudent(Request()->username);

        if ($cekLogin) {
            if ($this->verifyAndUpgradePassword('student', 'id', $cekLogin->id, Request()->password, $cekLogin->password)) {
                if ($cekLogin->status === 'Active') {
                    $detailStudent = $this->ModelAuth->detailStudent($cekLogin->id);

                    Session()->put('student_id', $detailStudent->student_id);
                    Session()->put('student_log', true);

                    return redirect()->route('index');
                } else {
                    return back()->with('error', 'Login Failed!! Your account is non-active.');
                }
            } else {
                return back()->with('error', 'Your Username Or Password incorrect.');
            }
        } else {
            return back()->with('error', 'Your Username Or Password incorrect.');
        }
    }

    public function logoutStudent()
    {
        Session()->forget('student_id');
        Session()->forget('student_log');
        return redirect()->route('index')->with('success', 'Logout berhasil');
    }

    private function verifyAndUpgradePassword(string $table, string $idColumn, $idValue, string $plainPassword, ?string $storedPassword): bool
    {
        if (!is_string($storedPassword) || $storedPassword === '') {
            return false;
        }

        $isHashed = password_get_info($storedPassword)['algo'] !== null;
        if ($isHashed && Hash::check($plainPassword, $storedPassword)) {
            if (Hash::needsRehash($storedPassword)) {
                DB::table($table)->where($idColumn, $idValue)->update([
                    'password' => Hash::make($plainPassword),
                ]);
            }
            return true;
        }

        // Backward compatibility for legacy plaintext passwords imported from old DB.
        if (hash_equals($storedPassword, $plainPassword)) {
            DB::table($table)->where($idColumn, $idValue)->update([
                'password' => Hash::make($plainPassword),
            ]);
            return true;
        }

        return false;
    }
}
