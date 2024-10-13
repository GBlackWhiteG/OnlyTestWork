<?php require_once VIEWS . '/incs/header.php'?>
<section class="login">
    <div class="container">
        <h2>Профиль</h2>
        <a href="/logout">Выход</a>
        <form action="/update-profile" method="post">
            <input type="hidden" value="<?= $user['id'] ?>" name="id">
            <input type="hidden" value="general" name="change-data">
            <div class="wrapper__form-items">
                <label for="name">Имя:</label>
                <input id="name" type="text" name="name" value="<?= $user['name'] ?>">
                <?php
                if (isset($errors['name']))
                    echo $errors['name'];
                ?>
            </div>
            <div class="wrapper__form-items">
                <label for="phone">Телефон:</label>
                <input id="phone" type="text" name="phone" value="<?= $user['phone'] ?>">
                <?php
                if (isset($errors['phone']))
                    echo $errors['phone'];
                ?>
            </div>
            <div class="wrapper__form-items">
                <label for="email">E-mail:</label>
                <input id="email" type="text" name="email" value="<?= $user['email'] ?>">
                <?php
                if (isset($errors['email']))
                    echo $errors['email'];
                ?>
            </div>
            <button type="submit">Изменить</button>
            <?php
            if (isset($errors['general'])) {
                echo $errors['general'];
            }
            ?>
        </form>
        <h4>Изменить пароль</h4>
        <form action="/update-profile" method="post">
            <input type="hidden" value="<?= $user['id'] ?>" name="id">
            <input type="hidden" value="password" name="change-data">
            <div class="wrapper__form-items">
                <label for="old_password">Старый пароль:</label>
                <input id="old_password" type="password" name="old_password">
            </div>
            <div class="wrapper__form-items">
                <label for="new_password">Новый пароль:</label>
                <input id="new_password" type="password" name="new_password">
            </div>
            <?php
            if (isset($errors['new-password'])) {
                echo $errors['new-password'];
            }
            ?>
            <button type="submit">Изменить</button>
            <?php
            if (isset($errors['password']) && !isset($errors['new-password'])) {
                echo $errors['password'];
            }
            ?>
        </form>
    </div>
</section>
</body>
<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</html>