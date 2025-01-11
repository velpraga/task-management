<?php

session_start();

require_once "./index.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

header("Location: dashboard.php");
exit();
