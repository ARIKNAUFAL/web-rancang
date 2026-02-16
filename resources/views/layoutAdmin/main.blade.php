<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guidance | {{ $title }}</title>
    <link rel="icon" href="{{ asset('templateAdmin/dist/image/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('templateAdmin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templateAdmin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templateAdmin/dist/css/admin-layout-modern.css') }}">
    @if (trim($__env->yieldContent('useDataTable')) === '1')
        <link rel="stylesheet"
            href="{{ asset('templateAdmin/bower_components/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('templateAdmin/bower_components/datatables/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('templateAdmin/bower_components/datatables/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @endif
</head>

<body>
    <div class="admin-shell">
        <aside class="admin-rail">
            <div class="rail-logo"><i class="fa fa-graduation-cap"></i></div>
            <div class="rail-spacer">M</div>
            <a class="rail-btn {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="fa fa-th-large"></i></a>
            <a class="rail-btn {{ Request::is('lesson-admin*') ? 'active' : '' }}" href="{{ route('admin.lesson.index') }}"><i class="fa fa-book"></i></a>
            <a class="rail-btn {{ Request::is('request-admin*') ? 'active' : '' }}" href="{{ route('admin.request.index') }}"><i class="fa fa-envelope-o"></i></a>
            <a class="rail-btn {{ Request::is('students*') ? 'active' : '' }}" href="{{ route('students.index') }}"><i class="fa fa-users"></i></a>
            <a class="rail-btn {{ Request::is('activity*') ? 'active' : '' }}" href="{{ url('/activity') }}"><i class="fa fa-history"></i></a>
            <a class="rail-btn {{ Request::is('category*') ? 'active' : '' }}" href="{{ url('/category') }}"><i class="fa fa-tags"></i></a>
            <div class="rail-footer">
                <a class="rail-btn {{ Request::is('change-password*') ? 'active' : '' }}" href="{{ url('/change-password') }}"><i class="fa fa-key"></i></a>
                <img src="{{ Session()->get('photo_profile') ? asset('userPhoto/' . Session()->get('photo_profile')) : asset('templateAdmin/dist/image/avatar.png') }}" alt="avatar">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="rail-btn"><i class="fa fa-sign-out"></i></button>
                </form>
            </div>
        </aside>

        <aside class="admin-side">
            <div class="side-brand"><i class="fa fa-graduation-cap"></i> Digilearn</div>

            <div class="side-label">MAIN</div>
            <a class="side-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="fa fa-th-large"></i> Dashboard</a>
            <a class="side-link {{ Request::is('lesson-admin*') ? 'active' : '' }}" href="{{ route('admin.lesson.index') }}"><i class="fa fa-book"></i> Lesson</a>
            <a class="side-link {{ Request::is('request-admin*') ? 'active' : '' }}" href="{{ route('admin.request.index') }}"><i class="fa fa-envelope-o"></i> Request</a>
            <a class="side-link {{ Request::is('students*') ? 'active' : '' }}" href="{{ route('students.index') }}"><i class="fa fa-users"></i> Student</a>
            <a class="side-link {{ Request::is('user-manage*') ? 'active' : '' }}" href="{{ url('/user-manage') }}"><i class="fa fa-user-circle-o"></i> User manage</a>
            <a class="side-link {{ Request::is('category*') ? 'active' : '' }}" href="{{ url('/category') }}"><i class="fa fa-tags"></i> Category</a>

            <div class="side-label">SYSTEM</div>
            <a class="side-link {{ Request::is('activity*') ? 'active' : '' }}" href="{{ url('/activity') }}"><i class="fa fa-history"></i> Activity log</a>
            <a class="side-link {{ Request::is('profile-admin*') || Request::is('update-profile-admin*') ? 'active' : '' }}" href="{{ url('/profile-admin/' . Session()->get('admin_id')) }}"><i class="fa fa-user"></i> My profile</a>
            <a class="side-link {{ Request::is('change-password*') ? 'active' : '' }}" href="{{ url('/change-password') }}"><i class="fa fa-key"></i> Change password</a>

            <div class="side-bottom">
                <div class="side-profile">
                    <img src="{{ Session()->get('photo_profile') ? asset('userPhoto/' . Session()->get('photo_profile')) : asset('templateAdmin/dist/image/avatar.png') }}" alt="avatar">
                    <div>
                        <div class="side-profile-name">{{ Session()->get('fullname') ?: 'Admin User' }}</div>
                        <div class="side-profile-role">System Admin</div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="side-logout" type="submit"><i class="fa fa-sign-out" style="margin-right:8px;"></i> Log out</button>
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <div class="admin-topbar">
                <h1 class="admin-title">{{ $title }}</h1>
                <div class="admin-sub"><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::now()->format('d M Y') }}</div>
            </div>
            <div class="admin-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('templateAdmin/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('templateAdmin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    @if (trim($__env->yieldContent('useDataTable')) === '1')
        <script src="{{ asset('templateAdmin/bower_components/datatables/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('templateAdmin/bower_components/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('templateAdmin/bower_components/datatables/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('templateAdmin/bower_components/datatables/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script>
            $(function() {
                if ($('#example2').length) {
                    $('#example2').DataTable({
                        paging: true,
                        lengthChange: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        autoWidth: true,
                        responsive: true,
                    });
                }
            });
        </script>
    @endif
    @yield('script')
</body>

</html>
