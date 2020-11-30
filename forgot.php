<?php session_start(); ?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Восстановление пароля</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/ico" href="favicon.ico">
</head>
<body>
<!-- Форма авторизации -->
<?php if(isset($_SESSION['user'])): ?>
    <meta http-equiv='refresh' content='0; url=profiles/profile.php'>
<?php else: ?>
    <form action="vendor/mail.php" method="POST">
        <h2 class="call_admin" >Связь с администратором</h2>
        <!-- Hidden Required Fields -->
        <input type="hidden" name="project_name" value="Отдел кадров">
        <input type="hidden" name="admin_email" value="help@sibd.romaniukmv.ru">
        <input type="hidden" name="form_subject" value="Восстановление пароля">
        <input type="hidden" name="site_email" value="no-reply@sibd.romaniukmv.ru">
        <!-- END Hidden Required Fields -->
        <label for="name">Фамилия и имя *</label>
        <input type="text" placeholder="Введите ваше имя и фамилию" name="Имя" id="name" autocomplete="off" required>
        <label for="login">Логин *</label>
        <input type="text" placeholder="Введите логин" name="Логин" id="login" autocomplete="off" required>
        <label for="phone">Телефон *</label>
        <input type="text" placeholder="Введите телефон" name="Телефон" id="phone" autocomplete="off" required>
        <label for="email">Почта *</label>
        <input type="text" placeholder="Введите почту" name="Почта" id="email" autocomplete="off" required>
        <label for="message">Дополнительные данные</label>
        <textarea rows="10" placeholder="Введите дополнительную информацию, если необходимо" name="Сообщение"  id="message"></textarea>
        <button class="button" type="submit">Связаться</button>
    </form>

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="assets/js/script.js"></script>

<?php endif; ?>
</body>
</html>