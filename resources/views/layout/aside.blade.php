<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <ul class="nav_list list-unstyled mb-5">
            <li class="aside-node">
                <a href="{{env('BASE_URL').'home'}}" class="nav_link">
                    <i class='fas fa-home'></i>
                    <span class="nav_name">Home</span>
                </a>
            </li>
            <!-- <li class="aside-node">
                <a href="{{env('BASE_URL').'dashboard'}}" class="nav_link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="nav_name">Dashboard</span>
                </a>
            </li> -->

            

            <!-- <li class="has-menu">
                <a href="#" class="nav_link">
                    <i class="fas fa-user"></i>
                    <span class="nav_name">User</span>
                </a>
                <ul class="submenu collapse list-unstyled">
                    <li class="aside-node">
                        <a href="{{env('BASE_URL').'users'}}" class="nav_link">
                            <i class="fas fa-angle-double-right"></i>
                            <span class="nav_name">User</span>
                        </a>
                    </li>
                </ul>
            </li> -->

            <li class="has-menu">
                <a href="#" class="nav_link">
                    <i class="fas fa-car"></i>
                    <span class="nav_name">Vehicles</span>
                </a>
                <ul class="submenu collapse list-unstyled">
                    <li class="aside-node">
                        <a href="{{env('BASE_URL').'vehicle'}}" class="nav_link">
                            <i class="fas fa-angle-double-right"></i>
                            <span class="nav_name">Vehicle</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="has-menu">
                <a href="#" class="nav_link">
                    <i class="fas fa-history"></i>
                    <span class="nav_name">Fuel Log</span>
                </a>
                <ul class="submenu collapse list-unstyled">
                    <li class="aside-node">
                        <a href="{{env('BASE_URL').'fuel-log'}}" class="nav_link">
                            <i class="fas fa-angle-double-right"></i>
                            <span class="nav_name">Fuel Log</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="has-menu">
                <a href="#" class="nav_link">
                    <i class="fas fa-cogs"></i>
                    <span class="nav_name">Materials/Parts</span>
                </a>
                <ul class="submenu collapse list-unstyled">
                    <li class="aside-node">
                        <a href="{{env('BASE_URL').'material'}}" class="nav_link">
                            <i class="fas fa-angle-double-right"></i>
                            <span class="nav_name">Materials</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="has-menu">
                <a href="#" class="nav_link">
                    <i class="fas fa-wrench"></i>
                    <span class="nav_name">Service Item</span>
                </a>
                <ul class="submenu collapse list-unstyled">
                    <li class="aside-node">
                        <a href="{{env('BASE_URL').'service-item'}}" class="nav_link">
                            <i class="fas fa-angle-double-right"></i>
                            <span class="nav_name">Service Item</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="has-menu">
                <a href="#" class="nav_link">
                    <i class="fas fa-wrench"></i>
                    <span class="nav_name">Service Schedule</span>
                </a>
                <ul class="submenu collapse list-unstyled">
                    <li class="aside-node">
                        <a href="{{env('BASE_URL').'service-schedule'}}" class="nav_link">
                            <i class="fas fa-angle-double-right"></i>
                            <span class="nav_name">Service Schedule</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- <li class="has-menu">
                <a href="#" class="nav_link">
                    <i class="fas fa-user"></i>
                    <span class="nav_name">Department</span>
                </a>
                <ul class="submenu collapse list-unstyled">
                    <li class="aside-node">
                        <a href="{{env('BASE_URL').'department'}}" class="nav_link">
                            <i class="fas fa-angle-double-right"></i>
                            <span class="nav_name">Department</span>
                        </a>
                    </li>
                </ul>
            </li> -->

            <!-- <li class="has-menu">
                <a href="#" class="nav_link">
                    <i class="fas fa-chart-pie"></i>
                    <span class="nav_name">Reports</span>
                </a>
                <ul class="submenu collapse list-unstyled">
                    <li class="aside-node">
                        <a href="{{env('BASE_URL').'student-attendances/filter-student-attendance'}}" class="nav_link">
                            <i class="fas fa-angle-double-right"></i>
                            <span class="nav_name">Student Attendance Filter</span>
                        </a>
                    </li>
                    <li class="aside-node">
                        <a href="{{env('BASE_URL').'user-attendances/filter-user-attendance'}}" class="nav_link">
                            <i class="fas fa-angle-double-right"></i>
                            <span class="nav_name">User Attendance Filter</span>
                        </a>
                    </li>
                </ul>
            </li> -->

            <li class="logout">
                <a href="#" class="nav_link logout">
                    <i class='fas fa-sign-out-alt'></i>
                    <span class="nav_name">Log Out</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
