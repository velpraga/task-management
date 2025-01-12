<?php
session_start();
define("SITE_URL", "http://localhost/task-management");
include "includes/db_connection.php";
include "includes/functions.php";

$isAdmin = !empty($_SESSION['user']['role']) && strtolower($_SESSION['user']['role']) == 'admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>

    <!-- Bootstrap CSS -->
    <link href=<?= SITE_URL . '/css/bootstrap.min.css' ?> rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Optional: Custom CSS -->
    <link rel="stylesheet" href=<?= SITE_URL . '/css/styles.css' ?>>
    <script src="<?= SITE_URL . '/js/bootstrap.min.js' ?>"></script>
    <script src="<?= SITE_URL . '/js/script.js' ?>"></script>
</head>

<body>