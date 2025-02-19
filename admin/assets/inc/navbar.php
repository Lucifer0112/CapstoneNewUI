
<!--navbar
<section id="topbar">
        topbar
        <nav>
            <i class='bx bx-menu toggle-sidebar' ></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search-alt icon' ></i>
                </div>
            </form>
            <a href="#" class="nav-link">
                <i class='bx bx-bell icon' ></i>
                <span class="badge">5</span>
            </a>
            <a href="#" class="nav-link">
                <i class='bx bx-chat icon' ></i>
                <span class="badge">8</span>
            </a>
            <span class="divider"></span>
            <div class="profile">
                <img src="./assets/image/profile.png" alt="">
                <ul class="profile-link">
                    <li><a href="admin_profile.php"><i class='bx bxs-user-circle icon' ></i>Profile</a></li>
                    <li><a href="admin_settings.php"><i class='bx bx-cog icon' ></i>Settings</a></li>
                    <li><a href="/logout.php"><i class='bx bx-log-out icon' ></i>Logout</a></li>
                </ul>
            </div>
        </nav>
        end topbar-->

        <!--end main-->
    <!--</section>-->
    
    <!--end navbar-->




    <nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <form class="form-inline mr-auto searchform text-muted">
        <input class="form-control  bg-transparent border-0 pl-4 " type="search" placeholder="Type something....." aria-label="Search">
    </form>

    <ul class="nav">


        <li class="nav-item">
            <section class="nav-link text-muted my-2 circle-icon" href="#" data-toggle="modal" data-target=".modal-shortcut">
                <span class="fe fe-message-circle fe-16"></span>
            </section>
        </li>


        <li class="nav-item nav-notif">
            <section class="nav-link text-muted my-2 circle-icon" href="#" data-toggle="modal" data-target=".modal-notif">
                <span class="fe fe-bell fe-16"></span>

                <span id="notification-count" style="
        position: absolute; 
        top: 12px; right: 5px; 
        font-size:13px; color: white;
        background-color: red;
        width:8px;
        height: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50px;
      ">

            </section>
        </li>

        <li class="nav-item dropdown">
            <span class="nav-link text-muted pr-0 avatar-icon" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <div class="avatar-img rounded-circle avatar-initials-min text-center position-relative">

                    <!--temporary-->
                    <img src="assets/image/profile.png" style="height: 150px; width: 150px; border-radius: 50%; object-fit: cover;">

                    </div>
                </span>
            </span>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="profile.php"><i class="fe fe-user"></i>&nbsp;&nbsp;&nbsp;Profile</a>
                <a class="dropdown-item" href="settings.php"><i class="fe fe-settings"></i>&nbsp;&nbsp;&nbsp;Settings</a>
                <a class="dropdown-log-out" href="logout.php"><i class="fe fe-log-out"></i>&nbsp;&nbsp;&nbsp;Log Out</a>
            </div>
        </li>
    </ul>
</nav>