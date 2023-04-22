<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <!-- [ navigation menu ] start -->
        <nav class="pcoded-navbar">
            <div class="nav-list">
                <div class="pcoded-inner-navbar main-menu">
                    <div class="pcoded-navigation-label">Navigation</div>
                    <ul class="pcoded-item pcoded-left-item">
                        <li class="">
                            <a href="{{ route('deshboard') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                <span class="pcoded-mtext">Dashboard</span>
                            </a>
                        </li>
                        <li class="pcoded-hasmenu">
                            <a href="javascript:void(0)" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                    <i class="fa fa-users"></i>
                                </span>
                                <span class="pcoded-mtext">User Management</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="">
                                    <a href="{{ route('user.management') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">User Management</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="{{ route('role') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-mtext">Role</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="">

                        </li>
                        <li class="">
                            <a href="{{ route('admin.settings') }}" class="waves-effect waves-dark">
                                <span class="pcoded-micon">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </span>
                                <span class="pcoded-mtext">Setting</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- [ navigation menu ] end -->
