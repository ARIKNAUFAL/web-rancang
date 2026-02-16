<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StudentLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $studentId = Session::get('student_id');
        if (Session::get('student_log') && $studentId) {
            $student = DB::table('student')
                ->where('id', $studentId)
                ->where('status', 'Active')
                ->first();

            if ($student) {
                return $next($request);
            }

            Session::forget(['student_id', 'student_log']);
            return redirect('/')->with('need_login', true);
        }

        if (Session::get('student_log')) {
            Session::forget(['student_id', 'student_log']);
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        return redirect('/')->with('need_login', true);
    }
}
