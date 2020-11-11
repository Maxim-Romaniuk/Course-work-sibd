<?php session_start(); ?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация на сайте</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Форма авторизации -->

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
    </form>

    </p>
</body>
</html>