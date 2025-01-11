<?php
session_start();
include "db_connection.php";
include "functions.php";
define("SITE_URL", "http://localhost/task-management");


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
</head>

<body>