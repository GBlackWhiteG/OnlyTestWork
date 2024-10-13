<?php

if (isset($_SESSION['user'])) {
    header('Location: /profile');
}

$errors = $_SESSION['errors'] ?? [];

require_once VIEWS . '/login.php';

unset($_SESSION['errors']);
