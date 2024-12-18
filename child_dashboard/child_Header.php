<?php
$child_name = isset($_GET['child_name']) ? htmlspecialchars(urldecode($_GET['child_name'])) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .logo span {
            color: #855e46;
        }
    </style>
</head>
<body>
<header id='header' class='header fixed-top d-flex align-items-center'>
    <div class='d-flex align-items-center justify-content-between'>
        <a href='../CuriousCubsNew.html' class='logo d-flex align-items-center'>
            <img src='assets/img/logo.png' alt=''>
            <span class='d-none d-lg-block' style='color:#855e46;font-size:30px'>Curious Cubs</span>
        </a>
        <i class='bi bi-list toggle-sidebar-btn' style='color:#855e46;'></i>
    </div><!-- End Logo -->

    <div class='search-bar'>
        <form class='search-form d-flex align-items-center' method='POST' action='#'>
            <input type='text' name='query' placeholder='Search' title='Enter search keyword' style='margin-top:15px;border:2px solid #855e46; border-radius:5px 5px 5px 5px; color:#855e46;'>
            <button type='submit' title='Search'><i class='bi bi-search' style='color:#855e46; padding-top:15px;'></i></button>
        </form>
    </div><!-- End Search Bar -->

    <nav class='header-nav ms-auto'>
        <ul class='d-flex align-items-center'>
            <li class='nav-item d-block d-lg-none'>
                <a class='nav-link nav-icon search-bar-toggle ' href='#'>
                    <i class='bi bi-search' style='color:#855e46;margin-top:15px;'></i>
                </a>
            </li><!-- End Search Icon-->

            <li class='nav-item dropdown'>
                <a class='nav-link nav-icon' href='#' data-bs-toggle='dropdown'>
                    <i class='bi bi-bell' style='color:#855e46;'></i>
                    <span class='badge bg-primary badge-number'></span>
                </a><!-- End Notification Icon -->

                <ul class='dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications'>
                    <li class='dropdown-header'>
                        You have 0 new notifications
                        <a href='#'><span class='badge rounded-pill bg-primary p-2 ms-2'>View all</span></a>
                    </li>

                    <li><hr class='dropdown-divider'></li>

                    <li><hr class='dropdown-divider'></li>
                    <li class='dropdown-footer'>
                        <a href='#'>Show all notifications</a>
                    </li>
                </ul><!-- End Notification Dropdown Items -->
            </li><!-- End Notification Nav -->

            <li class='nav-item dropdown'>
                <a class='nav-link nav-icon' href='#' data-bs-toggle='dropdown'>
                    <i class='bi bi-chat-left-text' style='color:#855e46;'></i>
                    <span class='badge bg-success badge-number'></span>
                </a><!-- End Messages Icon -->

                <ul class='dropdown-menu dropdown-menu-end dropdown-menu-arrow messages'>
                    <li class='dropdown-header'>
                        You have 0 new messages
                        <a href='#'><span class='badge rounded-pill bg-primary p-2 ms-2'>View all</span></a>
                    </li>
                    <li><hr class='dropdown-divider'></li>

                    <li class='dropdown-footer'>
                        <a href='#'>Show all messages</a>
                    </li>
                </ul><!-- End Messages Dropdown Items -->
            </li><!-- End Messages Nav -->

            <li class='nav-item dropdown pe-3'>
                <a class='nav-link nav-profile d-flex align-items-center pe-0' href='#' data-bs-toggle='dropdown'>
                    <img src='' class='rounded-circle'>
                    <span class='d-none d-md-block dropdown-toggle ps-2' style='color:#855e46;'><?php echo $child_name; ?></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class='dropdown-menu dropdown-menu-end dropdown-menu-arrow profile'>
                    <li class='dropdown-header'>
                        <h6><?php echo $child_name; ?></h6>
                        <span>Child</span>
                    </li>
                    <li><hr class='dropdown-divider'></li>

                    <li>
                        <a class='dropdown-item d-flex align-items-center' href='users-profile.html'>
                            <i class='bi bi-person'></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li><hr class='dropdown-divider'></li>

                    <li>
                        <a class='dropdown-item d-flex align-items-center' href='users-profile.html'>
                            <i class='bi bi-gear'></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li><hr class='dropdown-divider'></li>

                    <li>
                        <a class='dropdown-item d-flex align-items-center' href='pages-faq.html'>
                            <i class='bi bi-question-circle'></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li><hr class='dropdown-divider'></li>

                    <li>
                        <a class='dropdown-item d-flex align-items-center' href='../Auth/logout.php'>
                            <i class='bi bi-box-arrow-right'></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
</header><!-- End Header -->
</body>
</html>
