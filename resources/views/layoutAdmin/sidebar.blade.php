<!-- sidebar -->
<aside class="main-sidebar" style="background-color: #6044a4;">
    <section class="sidebar" style="background-color: #6044a4;">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header" style="background-color: #6044a4; color: white;">Utama</li>
            <li class="@if ($title === 'Dashboard') active @endif">
                <a href="/dashboard">
                    <i class="fa fa-book"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="header" style="background-color: #6044a4; color: white;">Data Master</li>
            <li class="treeview @if ($title === 'Website / User Manager' || $title === 'Website / User Manager / Register User') active @endif">
                <a href="#">
                    <i class="fa fa-pie-chart"></i> <span>Website</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if ($title === 'Website / User Manager' || $title === 'Website / User Manager / Register User') active @endif">
                        <a href="/user-manage">
                            <i class="fa fa-circle-o"></i> User
                        </a>
                    </li>
                    <li class="@if (Request::is('lesson-admin*')) active @endif">
                        <a href="{{ route('admin.lesson.index') }}">
                            <i class="fa fa-circle-o"></i> Lesson
                        </a>
                    </li>
                    <li class="@if (Request::is('activity')) active @endif">
                        <a href="/activity">
                            <i class="fa fa-circle-o"></i> Activity
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.request.index') }}">
                            <i class="fa fa-circle-o"></i> Request
                        </a>
                    </li>
                    <li class="@if ($title === 'Category') active @endif">
                        <a href="category">
                            <i class="fa fa-circle-o"></i> Category
                        </a>
                    </li>
                    <!-- Tambahkan Student -->
                    <li class="@if (Request::is('students')) active @endif">
                        <a href="{{ url('/students') }}">
                            <i class="fa fa-circle-o"></i> Student
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
