<?php require_once VIEWS . '/incs/header.php'?>
<section class="login">
    <div class="container">
        <h2>Вход</h2>
        <form action="/auth-login" class="" method="POST">
            <div class="wrapper__form-items">
                <label for="phone_email">Телефон или E-mail:</label>
                <input id="phone_email" type="text" name="phone_email" placeholder="89990009900">
                <?php
                if (isset($errors['phone_email']))
                    echo $errors['phone_email'];
                ?>
            </div>
            <div class="wrapper__form-items">
                <label for="password">Пароль:</label>
                <input id="password" type="password" name="password">
            </div>
            <div
                    id="captcha-container"
                    class="smart-captcha"
                    data-sitekey="ysc1_Pvo6R0ZhWPlbrzOENyMzDRgULctWqftpgtIfG80827394f5f"
            ></div>
            <?php
            if (isset($errors['captcha']))
                echo $errors['captcha'];
            ?>

            <button type="submit">Войти</button>
            <?php
            if (isset($errors['auth']))
                echo $errors['auth'];
            ?>
        </form>
        <p>Нет аккаунта? - <a href="/signup">зарегистрируйтесь</a></p>
    </div>
</section>
</body>
<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</html>