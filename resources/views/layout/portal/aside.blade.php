{{--<style>
    .submenu-node, .has-menu {
        display: none;
    }
</style>--}}
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <ul class="nav_list list-unstyled mb-5">
            <li class="submenu-node dashboard.index ">
                <a href="{{env('BASE_URL').'portal/dashboard'}}" class="nav_link">
                    <i class='fas fa-th-large'></i>
                    <span class="nav_name">Dashboard</span>
                </a>
            </li>

            <li class="submenu-node dashboard.index ">
                <a href="{{env('BASE_URL').'portal/booking'}}" class="nav_link">
                    <i class='fas fa-plus-circle'></i>
                    <span class="nav_name">Make Booking</span>
                </a>
            </li>

            <li class="submenu-node dashboard.index ">
                <a href="{{env('BASE_URL').'portal/booking-history'}}" class="nav_link">
                    <i class='fas fa-user-shield'></i>
                    <span class="nav_name">Booking History</span>
                </a>
            </li>

            <li class="submenu-node dashboard.index ">
                <a href="{{env('BASE_URL').'portal/account-setting'}}" class="nav_link">
                    <i class='fas fa-cogs'></i>
                    <span class="nav_name">Account Setting</span>
                </a>
            </li>

            <li>
                <a href="#" class="nav_link logout">
                    <i class='fas fa-sign-out-alt'></i>
                    <span class="nav_name">Log Out</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
