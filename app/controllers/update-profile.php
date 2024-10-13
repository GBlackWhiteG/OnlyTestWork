<?php

/**
 * @var Db $db ;
 */

$user_id = $_POST['id'];
$user = $db->query('SELECT * FROM users WHERE id = ?', [$user_id])->fetch();

$errors = [];

if ($user === false) {
    require_once CONTROLLERS . '/logout.php';
}

if ($_POST['change-data'] === 'general') {
    $fillable = ['name', 'phone', 'email'];

    $data = [];
    foreach ($_POST as $key => $value) {
        if (in_array($key, $fillable)) {
            $data[$key] = trim($value);
        }
    }

    if (isset($data['name'])) {
        $values['name'] = $data['name'];
        if (Validator::required($data['name'])) {
            $errors['name'] = 'Поле "Имя" обязательное';
        } else if (!Validator::min($data['name'], 3)) {
            $errors['name'] = 'Поле "Имя" должно быть не менее 3 символов';
        }
    }

    if (isset($data['phone'])) {
        $values['phone'] = $data['phone'];
        if (Validator::required($data['phone'])) {
            $errors['phone'] = 'Поле "Телефон" обязательное';
        } else if (!Validator::phoneNumber($data['phone'])) {
            $errors['phone'] = 'Невалидный номер телефона';
        }
    }

    if (isset($data['email'])) {
        $values['email'] = $data['email'];
        if (Validator::required($data['email'])) {
            $errors['email'] = 'Поле "Email" обязательное';
        } else if (!Validator::email($data['email'])) {
            $errors['email'] = 'Невалидный e-mail';
        }
    }

    if ($db->query('UPDATE users SET name = ?, phone = ?, email = ? WHERE id = ?', [$data['name'], $data['phone'], $data['email'], $user_id])) {
        $errors['general'] = 'Данные сохранены';
        $user = $db->query("SELECT * FROM users WHERE id = ?", [$user_id])->fetch();
        auth_user($user);
    } else {
        $errors['general'] = 'Ошибка при сохранении данных';
    }
} else if ($_POST['change-data'] === 'password') {
    $fillable = ['old_password', 'new_password'];

    $data = [];
    foreach ($_POST as $key => $value) {
        if (in_array($key, $fillable)) {
            $data[$key] = trim($value);
        }
    }

    if (isset($data['new_password'])) {
        if (Validator::required($data['new_password'])) {
            $errors['new-password'] = 'Поле "Новый пароль" обязательное';
        } else if (!Validator::min($data['new_password'], 6)) {
            $errors['new-password'] = 'Поле "Новый пароль" должно быть не менее 6 символов';
        }
    }

    if (password_verify($data['old-password'], $user['password'])) {
        if ($db->query('UPDATE users SET password = ? WHERE id = ?', [password_hash($data['new-password'], PASSWORD_DEFAULT), $user_id])) {
            $errors['password'] = 'Пароль успешно изменен';
        } else {
            $errors['password'] = 'Ошибка при изменении пароля';
        }
    } else {
        $errors['password'] = 'Неверный старый пароль';
    }
}

$_SESSION['errors'] = $errors;
header('Location: /profile');
exit;