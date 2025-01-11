<?php
if (!isset($_SESSION['user'])) {
    // Redirect to login if user not logged in
    header("Location: " . SITE_URL . "/login.php");
    exit();
}
global $isAdmin;
$userName = $_SESSION['user']['first_name'] ?? 'Admin';
?>

<body class="bg-light">

    <!-- Header -->
    <header class="navbar navbar-dark sticky-top bg-dark shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Task Management</a>
        <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="btn-group">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                Hello, <?= $userName ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-pencil-square me-2"></i>Edit Profile
                    </a>
                </li>
                <li>
                    <a href="<?= SITE_URL . '/logout.php' ?>" class="dropdown-item">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky">

                    <a href="<?= SITE_URL . '/dashboard.php' ?>" class="active">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>

                    <!-- Tasks Section -->
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#tasksMenu" aria-expanded="false">
                        <i class="bi bi-list-task me-2"></i>Tasks
                    </a>
                    <div class="collapse ps-3" id="tasksMenu">
                        <a href="<?= SITE_URL . ($isAdmin ? '/admin' : '') . '/tasks/list.php' ?>">All Tasks</a>
                        <?php if ($isAdmin): ?>
                            <a href="<?= SITE_URL . '/admin/tasks/AddEditTask.php' ?>">New Task</a>
                        <?php endif; ?>
                        <a href="<?= SITE_URL . ($isAdmin ? '/admin' : '') . '/tasks/list.php?status=completed' ?>">Completed Tasks</a>
                    </div>

                    <!-- Customers Section (Admin Only) -->
                    <?php if ($isAdmin): ?>
                        <a href="#" data-bs-toggle="collapse" data-bs-target="#customersMenu" aria-expanded="false">
                            <i class="bi bi-people me-2"></i>Customers
                        </a>
                        <div class="collapse ps-3" id="customersMenu">
                            <a href="<?= SITE_URL . '/admin/customers/list.php' ?>">All Customers</a>
                            <a href="<?= SITE_URL . '/admin/customers/AddEditCustomer.php' ?>">New Customer</a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">