<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Admin
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
        $adminId = Session::get('admin_id');
        $sessionStatus = Session::get('status');

        if (!$adminId || $sessionStatus !== 'Active') {
            return redirect()->route('login');
        }

        $admin = DB::table('admin')
            ->where('id', $adminId)
            ->where('status', 'Active')
            ->first();

        if ($admin) {
            return $next($request);
        }

        Session::forget(['admin_id', 'fullname', 'photo_profile', 'email', 'status', 'log']);
        return redirect()->route('login');
    }
}
