<?php
session_start();
include "db_connection.php";
include "functions.php";
define("SITE_URL", "http://localhost/task-management");

$isAdmin = !empty($_SESSION['user']['role']) && strtolower($_SESSION['user']['role']) == 'admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>

    <!-- Bootstrap CSS -->
    <link href=<?= SITE_URL . '/bootstrap.min.css' ?> rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Optional: Custom CSS -->
    <link rel="stylesheet" href=<?= SITE_URL . '/styles.css' ?>>
    <script src="<?= SITE_URL . '/bootstrap.min.js' ?>"></script>
</head>

<body>