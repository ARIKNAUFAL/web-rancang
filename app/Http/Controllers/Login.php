<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelAuth;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    public function forgotPasswordForm()
    {
        return view('login.forgot-password', [
            'title' => 'Forgot Password',
        ]);
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $admin = DB::table('admin')->where('email', $email)->first();

        // Avoid account enumeration by always returning the same response.
        if (!$admin) {
            return back()->with('status', 'Jika email terdaftar, link reset password telah dikirim.');
        }

        $token = Str::random(64);
        DB::table('admin_password_resets')->updateOrInsert(
            ['email' => $email],
            [
                'token' => hash('sha256', $token),
                'created_at' => now(),
            ]
        );

        $resetLink = route('password.admin.reset.form', ['token' => $token, 'email' => $email]);

        try {
            Mail::raw(
                "Klik link berikut untuk reset password admin:\n{$resetLink}\n\nLink berlaku 60 menit.",
                function ($message) use ($email) {
                    $message->to($email)->subject('Reset Password Admin');
                }
            );
        } catch (\Throwable $e) {
            // Ignore mail transport failures and keep generic response.
        }

        return back()
            ->with('status', 'Jika email terdaftar, link reset password telah dikirim.')
            ->with('reset_link_preview', app()->environment(['local', 'development']) ? $resetLink : null);
    }

    public function resetPasswordForm(Request $request, string $token)
    {
        $email = (string) $request->query('email', '');

        if ($email === '') {
            return redirect()->route('password.admin.request')->with('error', 'Link reset tidak valid.');
        }

        return view('login.reset-password', [
            'title' => 'Reset Password',
            'token' => $token,
            'email' => $email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $resetRow = DB::table('admin_password_resets')
            ->where('email', $request->email)
            ->first();

        if (!$resetRow) {
            return back()->with('error', 'Token reset tidak valid.');
        }

        if (Carbon::parse($resetRow->created_at)->addMinutes(60)->isPast()) {
            DB::table('admin_password_resets')->where('email', $request->email)->delete();
            return back()->with('error', 'Token reset sudah kedaluwarsa. Silakan minta link baru.');
        }

        if (!hash_equals((string) $resetRow->token, hash('sha256', $request->token))) {
            return back()->with('error', 'Token reset tidak valid.');
        }

        $updated = DB::table('admin')
            ->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        if (!$updated) {
            return back()->with('error', 'Akun admin tidak ditemukan.');
        }

        DB::table('admin_password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login.');
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
