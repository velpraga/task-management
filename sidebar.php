<!-- Sidebar -->
<nav class="sidebar">
    <div class="sidebar-header">
        <span>Admin Dashboard</span>
    </div>
    <a href=<?= SITE_URL . '/dashboard.php'?> class="active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href='#' data-bs-toggle="collapse" data-bs-target="#tasksMenu" aria-expanded="false">
        <i class="bi bi-list-task"></i>
        Tasks
    </a>
    <div class="collapse" id="tasksMenu">
        <a href=<?= SITE_URL . '/admin/tasks/list.php'?> class="ms-4"><i class="bi bi-card-checklist"></i>All Task</a>
    </div>
    <div class="collapse" id="tasksMenu">
        <a href=<?= SITE_URL . '/admin/tasks/AddEditTask.php'?> class="ms-4"><i class="bi bi-card-checklist"></i>New Task</a>
    </div>
    <a href='#' data-bs-toggle="collapse" data-bs-target="#customersMenu" aria-expanded="false">
        <i class="bi bi-people"></i> Customers
    </a>
    <div class="collapse" id="customersMenu">
        <a href=<?= SITE_URL . '/admin/customers/list.php'?> class="ms-4"><i class="bi bi-people"></i></i>All Customers</a>
    </div>
    <div class="collapse" id="customersMenu">
        <a href=<?= SITE_URL . '/admin/customers/AddEditCustomer.php'?> class="ms-4"><i class="bi bi-person-add"></i>New Customer</a>
    </div>
    <a href=<?= SITE_URL . '/logout.php'?> >
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</nav>
<div class="content">
    <button class="btn btn-primary menu-toggle" onclick="toggleSidebar()"><i class="bi bi-list"></i>Menu</button>