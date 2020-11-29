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
    <form action="vendor/mail.php" method="POST">
        <h2 class="call_admin" >Связь с администратором</h2>
        <!-- Hidden Required Fields -->
        <input type="hidden" name="project_name" value="Отдел кадров">
        <input type="hidden" name="admin_email" value="help@sibd.romaniukmv.ru">
        <input type="hidden" name="form_subject" value="Восстановление пароля">
        <input type="hidden" name="site_email" value="no-reply@sibd.romaniukmv.ru">
        <!-- END Hidden Required Fields -->
        <label>Фамилия и имя *</label>
        <input type="text" placeholder="Введите ваше имя и фамилию" name="Имя" required>
        <label>Логин *</label>
        <input type="text" placeholder="Введите логин" name="Логин" required>
        <label>Телефон *</label>
        <input type="text" placeholder="Введите телефон" name="Телефон" required>
        <label>Почта *</label>
        <input type="text" placeholder="Введите почту" name="Почта" required>
        <label>Дополнительные данные</label>
        <textarea rows="10" placeholder="Введите дополнительную информацию, если необходимо" name="Сообщение"></textarea>
        <button class="button" type="submit">Связаться</button>
    </form>

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="assets/js/script.js"></script>

<?php endif; ?>
</body>
</html>