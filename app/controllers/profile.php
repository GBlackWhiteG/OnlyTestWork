<?php

if (!isset($_SESSION['user'])) {
    header('Location: /login');
}

$user = $_SESSION['user'] ?? [];
$errors = $_SESSION['errors'] ?? [];

require_once VIEWS . '/profile.php';

unset($_SESSION['errors']);
