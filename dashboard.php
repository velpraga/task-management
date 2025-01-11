<?php 
include('header.php'); 
include('sidebar.php');
$user = $_SESSION['user'];
global $isAdmin;
?>
<!-- Main Content -->
<h1 class="mb-4">Welcome <?php echo htmlspecialchars($user['first_name']); ?>!</h1>
<div class="content-header">
    <h1 class="h4">Dashboard</h1>
    <p class="text-muted">Overview of your admin panel</p>
</div>
<!-- Example Dashboard Widgets -->
<div class="row g-3">
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Tasks</h5>
                <p class="card-text">Manage and track all your tasks.</p>
                <a href="<?= SITE_URL . ($isAdmin ? '/admin' : '') . '/tasks/list.php' ?>" class="btn btn-primary btn-sm">View Tasks</a>
            </div>
        </div>
    </div>
    <?php if ($isAdmin): ?>
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Customers</h5>
                    <p class="card-text">View and manage customer data.</p>
                    <a href="<?= SITE_URL . '/admin/customers/list.php' ?>" class="btn btn-primary btn-sm">View Customers</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Reports</h5>
                <p class="card-text">Analyze data and generate reports.</p>
                <a href="<?= SITE_URL . '/reports.php' ?>" class="btn btn-primary btn-sm">View Reports</a>
            </div>
        </div>
    </div> -->
</div>
</main>

<?php include('footer.php'); ?>