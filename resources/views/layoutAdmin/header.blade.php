<!-- Header -->
<header class="main-header">
    <a href="{{ route('dashboard') }}" class="logo" style="background-color: #484c5c;">
        <span class="logo-mini"><b>J</b>WD</span>
        <span class="logo-lg"><b>Digilearn</b>Admin</span>
    </a>
    <nav class="navbar navbar-static-top" style="background-color: #6044a4;">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ Session()->get('photo_profile') ? asset('userPhoto/' . Session()->get('photo_profile')) : asset('templateAdmin/dist/image/avatar.png') }}"
                            class="user-image" alt="User Image">
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header" style="background-color: #484c5c;">
                            {{-- <img src="{{ asset('foto_user/'.Auth::user()->photo) }}" alt="Profile" class="rounded-circle"> --}}
                            <img src="{{ Session()->get('photo_profile') ? asset('userPhoto/' . Session()->get('photo_profile')) : asset('templateAdmin/dist/image/avatar.png') }}"
                                class="img-circle" alt="User Image">
                            <p>
                                {{ Session()->get('fullname') }} - Admin
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/profile-admin/{{ Session()->get('admin_id') }}"
                                    class="btn btn-default btn-flat">My Profile</a>
                            </div>
                            <div class="pull-right">
                                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat">Sign out</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Tutup Header -->
