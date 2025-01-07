<!-- Sidebar -->
<nav class="sidebar">
    <div class="sidebar-header">
        <span>Admin Dashboard</span>
    </div>
    <a href="#" class="active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="#" data-bs-toggle="collapse" data-bs-target="#tasksMenu" aria-expanded="false">
        <i class="bi bi-list-task"></i>
        Tasks
    </a>
    <div class="collapse" id="tasksMenu">
        <a href="#" class="ms-4"><i class="bi bi-card-checklist"></i>New Task</a>
    </div>
    <a href="#" data-bs-toggle="collapse" data-bs-target="#customersMenu" aria-expanded="false">
        <i class="bi bi-people"></i> Customers
    </a>
    <div class="collapse" id="customersMenu">
        <a href="#" class="ms-4"><i class="bi bi-person-add"></i>New Customer</a>
    </div>
    <a href="logout.php">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</nav>
<div class="content">
    <button class="btn btn-primary menu-toggle" onclick="toggleSidebar()"><i class="bi bi-list"></i>Menu</button>