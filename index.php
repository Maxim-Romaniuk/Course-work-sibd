<?php session_start(); ?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
   <?php require('assets/head.html'); ?>
</head>
<body>
    <!-- Форма авторизации -->
<?php if(isset($_SESSION['user'])): ?>
    <meta http-equiv='refresh' content='0; url=profiles/profile.php'>
<?php else: ?>
    <form action="vendor/signin.php" method="POST">
        <label>Логин</label>
        <input type="text" placeholder="Введите логин" name="login">
        <label>Пароль</label>
        <input type="password" placeholder="Введите пароль" name="password">
        <button class="button" type="submit">Войти</button>

        <?php
        if ($_SESSION['message']) {
            echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
        }
        unset($_SESSION['message']);
        ?>
        <p class="forgot">Забыли пароль? <a class="call_admin" href="forgot.php">Связаться с администратором</a></p>
    </form>

<?php endif; ?>
</body>
</html>