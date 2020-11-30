<?php session_start(); ?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/ico" href="favicon.ico">
</head>
<body>
    <!-- Форма авторизации -->
<?php if(isset($_SESSION['user'])): ?>
    <meta http-equiv='refresh' content='0; url=profile.php'>
<?php else: ?>
    <form action="vendor/signin.php" method="POST">
        <label for="login">Логин</label>
        <input type="text" placeholder="Введите логин" name="login" id="login" required>
        <label for="password">Пароль</label>
        <input type="password" placeholder="Введите пароль" name="password" id="password" required>
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