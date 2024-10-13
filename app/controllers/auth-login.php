<?php

/**
 * @var Db $db;
 */

$fillable = ['phone_email', 'password'];

$data = [];
foreach ($_POST as $key => $value) {
    if (in_array($key, $fillable)) {
        $data[$key] = trim($value);
    }
}

$errors = [];

$auth_field = '';
if (isset($data['phone_email'])) {
    if (is_numeric($data['phone_email'])) {
        $auth_field = 'phone';
    } else {
        $auth_field = 'email';
    }
}

define('SMARTCAPTCHA_SERVER_KEY', '');

function check_captcha($token)
{
    $ch = curl_init("https://smartcaptcha.yandexcloud.net/validate");
    $args = [
        "secret" => SMARTCAPTCHA_SERVER_KEY,
        "token" => $token,
        "ip" => $_SERVER['REMOTE_ADDR'],
    ];
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode !== 200) {
        return false;
    }

    $resp = json_decode($server_output);
    return $resp->status === "ok";
}

$token = $_POST['smart-token'];
if (!check_captcha($token)) {
    $errors['captcha'] = 'Неверная капча';
}

if ($errors) {
    $_SESSION['errors'] = $errors;
    header('Location: /login');
    exit;
}

$user = $db->query("SELECT * FROM users WHERE {$auth_field} = ?", [$data['phone_email']])->fetch();

if (isset($user) && password_verify($data['password'], $user['password'])) {
    auth_user($user);
    header('Location: /profile');
} else {
    $errors['auth'] = 'Неверные данные';
    $_SESSION['errors'] = $errors;
    header('Location: /login');
    exit;
}
