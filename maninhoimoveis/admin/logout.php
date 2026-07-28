<?php
require_once __DIR__ . '/includes/admin-auth.php';
$_SESSION = [];
session_destroy();
header('Location: login.php');
exit;
