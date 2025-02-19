<!--sidebar
<section id="sidebar">
        <a href="index.php" class="logo"><img src="./assets/image/logo.jpg" alt=""> <span>LGU: 3</span></a>
        <ul class="side-menu">
            <li class="divider" data-text="main">Main</li>
            <li><a href="admin_dashboard.php" class="active"><i class='bx bxs-dashboard icon'></i>Dashboard</a></li>
            <li><a href="admin_registration_list.php"><i class='bx bxs-user-detail icon'></i>Registration List</a></li>
            <li><a href="admin_renewal_list.php"><i class='bx bxs-user-detail icon'></i>Renewal List</a></li>
            <li><a href="admin_business_aprove_list_data.php"><i class='bx bxs-briefcase icon'></i>Registered Business</a></li>

            <li class="divider" data-text="maintenance">Maintenance</li>
            <li><a href="admin_registration.php"><i class='bx bxs-user-plus icon' ></i>Registration</a></li>
            <li><a href="admin_renewal.php"><i class='bx bxs-user-check icon' ></i>Renewal</a></li>

            <li class="divider" data-text="maintenance">Maintenance</li>
            <li><a href="admin_admin_list.php"><i class='bx bxs-user-plus icon'></i>Admin List</a></li>
            <li><a href="admin_employee_list.php"><i class='bx bxs-user-plus icon'></i>Employee List</a></li>
            <li><a href="admin_user_list.php"><i class='bx bxs-user-plus icon'></i>User List</a></li>
            <li class="divider" data-text="settings">Settings</li>
            <li><a href="admin_settings.php"><i class='bx bxs-cog icon' ></i>Settings</a></li>
        </ul>
        <div class="ads">
            <div class="wrapper">
                <a href="#" class="btn-upgrade">INFO</a>
                <p>Local Government Unit<span> LGU</span> are foundational to democracy, tasked with maintaining order and improving community life.<span> When citizens vote, they entrust officials with significant powers, such as levying taxes, to meet municipal goals. </span></p>
            </div>
        </div>
    </section>
    end sidebar-->















    <!--active if you click one of the sidebar-->
<?php 

$pageName = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/") +1);

?>



<aside class="sidebar-left border-right bg-white " id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>

    <nav class="vertnav navbar-side navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="index.php">
                <img src="assets/image/unified-lgu-logo.png" width="45">
                <div class="brand-title">
                    <br>
                    <span>LGU3 - BUSINESS REGISTRATION <br> AND RENEWAL SYSTEM </span>
                </div>
            </a>
        </div>

        <!--Sidebar ito-->
        <ul class="navbar-nav <?= $pageName == 'admin_dashboard.php' ? 'active':''; ?> flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a class="nav-link" href="admin_dashboard.php">
                    <i class="fas fa-chart-line"></i>
                    <span class="ml-3 item-text">Dashboard</span>

                </a>
            </li>
        </ul>

       <p class="text-muted-nav nav-heading mt-4 mb-1">
            <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">MAIN COMPONENTS</span>
        </p>

         <!--<ul class="navbar-nav flex-fill w-100 mb-2">
            <ul class="navbar-nav 
                <?= $pageName == 'registration-manage.php' ? 'active':''; ?> 
                <?= $pageName == 'registration-create.php' ? 'active':''; ?>
            flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="registration-manage.php">
                        <i class="fa-regular fa-address-card"></i>
                        <span class="ml-3 item-text">Registration</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav 
                <?= $pageName == 'renewal-manage.php' ? 'active':''; ?> 
                <?= $pageName == 'renewal-create.php' ? 'active':''; ?> 
            flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="renewal-manage.php">
                        <i class="fa-solid fa-address-card"></i>
                        <span class="ml-3 item-text">Renewal</span>
                    </a>
                </li>
            </ul>-->

            <!--<ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-wrench"></i>
                        <span class="ml-3 item-text">Module 1</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-wrench"></i>
                        <span class="ml-3 item-text">Module 2</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item dropdown">
                    <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fa-solid fa-users"></i>
                        <span class="ml-3 item-text">User's</span>  <span class="sr-only">(current)</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="users">
                        <li class="nav-item active">
                            <a class="nav-link pl-3" href="#"><span class="ml-1 item-text">Add User</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="#"><span class="ml-1 item-text">Manage User</span></a>
                        </li>

                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item dropdown">
                    <a href="#pages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fa-solid fa-wrench"></i>
                        <span class="ml-3 item-text">Module 5</span><span class="sr-only">(current)</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="pages">
                        <li class="nav-item active">
                            <a class="nav-link pl-3" href="#"><span class="ml-1 item-text">Sub Module 5.1</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="#"><span class="ml-1 item-text">Sub Module 5.2</span></a>
                        </li>

                    </ul>
                </li>
            </ul>-->

            

            <!--<p class="text-muted-nav nav-heading mt-4 mb-1">
                <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">OTHER COMPONENTS</span>
            </p>

            <ul class="navbar-nav 
                <?= $pageName == 'users-manage.php' ? 'active':''; ?> 
                <?= $pageName == 'users-create.php' ? 'active':''; ?>
                <?= $pageName == 'users-edit.php' ? 'active':''; ?>
            flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="users-manage.php">
                        <i class="fa-solid fa-users"></i>
                        <span class="ml-3 item-text">User's</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav 
                <?= $pageName == 'admins-manage.php' ? 'active':''; ?> 
                <?= $pageName == 'admins-create.php' ? 'active':''; ?> 
                <?= $pageName == 'admins-edit.php' ? 'active':''; ?> 
            flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="admins-manage.php">
                        <i class="fa-solid fa-user-secret"></i>
                        <span class="ml-3 item-text">Admin</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav 
                <?= $pageName == 'subadmins-manage.php' ? 'active':''; ?> 
                <?= $pageName == 'subadmins-create.php' ? 'active':''; ?> 
                <?= $pageName == 'subadmins-edit.php' ? 'active':''; ?> 
            flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="subadmins-manage.php">
                        <i class="fa-solid fa-user-tie"></i>
                        <span class="ml-3 item-text">Sub Admin</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav 
                <?= $pageName == 'employees-manage.php' ? 'active':''; ?> 
                <?= $pageName == 'employees-create.php' ? 'active':''; ?> 
                <?= $pageName == 'employees-edit.php' ? 'active':''; ?> 
            flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="employees-manage.php">
                        <i class="fa-solid fa-user-tie"></i>
                        <span class="ml-3 item-text">Employee</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav 
                <?= $pageName == 'applicants-manage.php' ? 'active':''; ?> 
                <?= $pageName == 'applicants-create.php' ? 'active':''; ?> 
                <?= $pageName == 'applicants-edit.php' ? 'active':''; ?> 
            flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="applicants-manage.php">
                        <i class="fa-solid fa-user"></i>
                        <span class="ml-3 item-text">User</span>
                    </a>
                </li>
            </ul>



            <p class="text-muted-nav nav-heading mt-4 mb-1">
                <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">OTHER COMPONENTS</span>
            </p>

            <ul class="navbar-nav 
                <?= $pageName == 'social-media.php' ? 'active':''; ?> 
                <?= $pageName == 'social-media-create.php' ? 'active':''; ?> 
                <?= $pageName == 'social-media-edit.php' ? 'active':''; ?> 
            flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="social-media.php">
                        <i class="fa-solid fa-tv"></i>
                        <span class="ml-3 item-text">Social media</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav 
                <?= $pageName == 'services.php' ? 'active':''; ?> 
                <?= $pageName == 'services-create.php' ? 'active':''; ?> 
                <?= $pageName == 'services-edit.php' ? 'active':''; ?> 
            flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="services.php">
                        <i class="fa-solid fa-tv"></i>
                        <span class="ml-3 item-text">Services or features</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav 
                <?= $pageName == 'enquiries.php' ? 'active':''; ?> 
                <?= $pageName == 'enquiries-view.php' ? 'active':''; ?> 
            flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="enquiries.php">
                        <i class="fa-solid fa-tv"></i>
                        <span class="ml-3 item-text">Enquiries</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav 
                <?= $pageName == 'calendar-event.php' ? 'active':''; ?> flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="calendar-event.php">
                        <i class="fa-solid fa-tv"></i>
                        <span class="ml-3 item-text">Calendar Event</span>
                    </a>
                </li>
            </ul>-->













            <!--<p class="text-muted-nav nav-heading mt-4 mb-1">
                <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">OTHER COMPONENTS</span>
            </p>-->

            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="admin_registration_list.php">
                        <i class="fa-solid fa-tv"></i>
                        <span class="ml-3 item-text">Registration List</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="admin_renewal_list.php">
                        <i class="fa-solid fa-tv"></i>
                        <span class="ml-3 item-text">Renewal List</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="admin_business_aprove_list_data.php">
                        <i class="fa-solid fa-tv"></i>
                        <span class="ml-3 item-text">Registered Business</span>
                    </a>
                </li>
            </ul>




            <p class="text-muted-nav nav-heading mt-4 mb-1">
                <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">OTHER COMPONENTS</span>
            </p>

            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="admin_registration.php">
                        <i class="fa-solid fa-tv"></i>
                        <span class="ml-3 item-text">Registration</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="admin_renewal.php">
                        <i class="fa-solid fa-tv"></i>
                        <span class="ml-3 item-text">Renewal</span>
                    </a>
                </li>
            </ul>











            <p class="text-muted-nav nav-heading mt-4 mb-1">
                <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">OTHER COMPONENTS</span>
            </p>

            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="admin_admin_list.php">
                        <i class="fa-solid fa-tv"></i>
                        <span class="ml-3 item-text">Admin List</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav <?= $pageName == 'admin_employee_list.php' ? 'active':''; ?> 
            flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="admin_employee_list.php">
                        <i class="fa-solid fa-tv"></i>
                        <span class="ml-3 item-text">Employee List</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="admin_user_list.php">
                        <i class="fa-solid fa-tv"></i>
                        <span class="ml-3 item-text">User List</span>
                    </a>
                </li>
            </ul>














            <p class="text-muted-nav nav-heading mt-4 mb-1">
                <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">SETTINGS</span>
            </p>

            <ul class="navbar-nav <?= $pageName == 'settings.php' ? 'active':''; ?> flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="settings.php">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        <span class="ml-3 item-text">Settings</span>
                    </a>
                </li>
            </ul>
        </ul>
    </nav>
</aside>

