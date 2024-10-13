<?php require_once VIEWS . '/incs/header.php'?>
<section class="login">
    <div class="container">
        <h2>Регистрация</h2>
        <form action="/store-signup" class="" method="POST">
            <div class="wrapper__form-items">
                <label for="name">Имя:</label>
                <input id="name" type="text" name="name" value="<?= $_SESSION['values']['name'] ?? '' ?>">
                <?php
                if (isset($errors['name']))
                    echo $errors['name'];
                ?>
            </div>
            <div class="wrapper__form-items">
                <label for="phone">Телефон:</label>
                <input id="phone" type="text" name="phone" placeholder="89990009900"
                       value="<?= $_SESSION['values']['phone'] ?? '' ?>">
                <?php
                if (isset($errors['phone']))
                    echo $errors['phone'];
                ?>
            </div>
            <div class="wrapper__form-items">
                <label for="email">E-mail:</label>
                <input id="email" type="text" name="email" value="<?= $_SESSION['values']['email'] ?? '' ?>">
                <?php
                if (isset($errors['email']))
                    echo $errors['email'];
                ?>
            </div>
            <div class="wrapper__form-items">
                <label for="password">Пароль:</label>
                <input id="password" type="password" name="password">
                <?php
                if (isset($errors['password']))
                    echo $errors['password'];
                ?>
            </div>
            <div class="wrapper__form-items">
                <label for="confirm_password">Подтверждение пароля:</label>
                <input id="confirm_password" type="password" name="confirm_password">
                <?php
                if (isset($errors['confirm_password']))
                    echo $errors['confirm_password'];
                ?>
            </div>

            <button type="submit">Зарегистрироваться</button>
        </form>
        <p>Есть аккаунта? - <a href="/login">авторизируйтесь</a></p>
    </div>
</section>
</body>
</html>