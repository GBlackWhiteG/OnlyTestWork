<?php

/**
 * @var Db $db;
 */

$fillable = ['name', 'phone', 'email', 'password', 'confirm_password'];

$data = [];
foreach ($_POST as $key => $value) {
    if (in_array($key, $fillable)) {
        $data[$key] = trim($value);
    }
}

$values = [];
$errors = [];

if (isset($data['name'])) {
    $values['name'] = $data['name'];
    if (Validator::required($data['name'])) {
        $errors['name'] = 'Поле "Имя" обязательное';
    } else if (!Validator::min($data['name'], 3)) {
        $errors['name'] = 'Поле "Имя" должно быть не менее 3 символов';
    } else if (!Validator::unique('name', $data['name'])) {
        $errors['name'] = 'Пользователь с таким именем уже существует';
    }
}

if (isset($data['phone'])) {
    $values['phone'] = $data['phone'];
    if (Validator::required($data['phone'])) {
        $errors['phone'] = 'Поле "Телефон" обязательное';
    } else if (!Validator::phoneNumber($data['phone'])) {
        $errors['phone'] = 'Невалидный номер телефона';
    } else if (!Validator::unique('phone', $data['phone'])) {
        $errors['phone'] = 'Пользователь с таким номером телефона уже существует';
    }
}

if (isset($data['email'])) {
    $values['email'] = $data['email'];
    if (Validator::required($data['email'])) {
        $errors['email'] = 'Поле "Email" обязательное';
    } else if (!Validator::email($data['email'])) {
        $errors['email'] = 'Невалидный e-mail';
    } else if (!Validator::unique('email', $data['email'])) {
        $errors['email'] = 'Пользователь с таким e-mail уже существует';
    }
}

if (isset($data['password'])) {
    if (Validator::required($data['password'])) {
        $errors['password'] = 'Поле "Пароль" обязательное';
    } else if (!Validator::min($data['password'], 6)) {
        $errors['password'] = 'Поле "Пароль" должно быть не менее 6 символов';
    }
}
if (!empty($errors)) {
    $_SESSION['values'] = $values;
    $_SESSION['errors'] = $errors;
    header('Location: /signup');
    exit;
}

$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
unset($data['confirm_password']);
if ($user = $db->query("INSERT INTO users (`name`, `phone`, `email`, `password`) VALUES (:name, :phone, :email, :password)", $data)) {
    $_SESSION['register'] = 'success';
    $user = $user->fetch();
    auth_user($user);
    header('Location: /profile');
} else {
    $_SESSION['register'] = 'error';
}