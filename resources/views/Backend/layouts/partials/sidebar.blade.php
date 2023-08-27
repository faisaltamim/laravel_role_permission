<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a style="max-width: 220px;" href="{{ route('admin.dashboard') }}"><img class="img img-fluid"
                    src="{{ asset('Backend/assets/images/icon/logo.png') }}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li
                        class="{{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" aria-expanded="true"><i
                                class="ti-dashboard"></i><span>Dashboard</span></a>

                    </li>
                    <li
                        class="{{ request()->routeIs('admin.roles.index') || request()->routeIs('admin.roles.create') || request()->routeIs('admin.roles.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-key"
                                aria-hidden="true"></i><span>Roles</span></a>
                        <ul class="collapse">
                            <li><a class="{{ request()->routeIs('admin.roles.index') || request()->routeIs('admin.roles.edit') ? 'activeLink' : '' }}"
                                    href="{{ route('admin.roles.index') }}">Manage Roles</a></li>
                            <li><a class="{{ request()->routeIs('admin.roles.create') ? 'activeLink' : '' }}"
                                    href="{{ route('admin.roles.create') }}">Create
                                    Role</a></li>
                        </ul>
                    </li>
                    <li
                        class="{{ request()->routeIs('admin.users.index') || request()->routeIs('admin.users.create') || request()->routeIs('admin.users.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-users"
                                aria-hidden="true"></i><span>Users</span></a>
                        <ul class="collapse">
                            <li><a class="{{ request()->routeIs('admin.users.index') || request()->routeIs('admin.users.edit') ? 'activeLink' : '' }}"
                                    href="{{ route('admin.users.index') }}">Manage Users</a></li>
                            <li><a class="{{ request()->routeIs('admin.users.create') ? 'activeLink' : '' }}"
                                    href="{{ route('admin.users.create') }}">Create
                                    User</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
