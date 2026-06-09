<?php

require_once __DIR__ . '/../includes/bootstrap.php';

unset($_SESSION['admin_logged_in'], $_SESSION['admin_username']);
header('Location: ' . BASE_URL . '/admin/login.php');
exit;
