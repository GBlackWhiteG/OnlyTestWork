<?php

if (isset($_SESSION['user'])) {
    header('Location: /profile');
}

$values = $_SESSION['values'] ?? [];
$errors = $_SESSION['errors'] ?? [];

require_once VIEWS . '/signup.php';

unset($_SESSION['values']);
unset($_SESSION['errors']);
