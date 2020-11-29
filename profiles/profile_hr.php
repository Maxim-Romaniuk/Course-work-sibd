<?php
session_start();
?>


<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
<?php if(!isset($_SESSION['user']) || empty($_SESSION['user'])):
    echo("<h1 align='center'>Ошибка! Неоходимо авторизоваться<br>Через 5 секунд произойдет переадресация на страницу входа</h1>
          <meta http-equiv='refresh' content='5; url=../index.php'>");
elseif($_SESSION['user']['lvl']!=5):
    echo("<h1 align='center'>Ошибка! У вас нет прав для просмотра данной страницы<br>Через 5 секунд произойдет переадресация в ваш профиль</h1>
          <meta http-equiv='refresh' content='5; url=../profile.php'>");
    ?>
<?php else: ?>
<form>
    <h1 align="center">Добро пожаловать, <?=$_SESSION['user']['login']?>! </h1>
    <h2 align="center">Ваш ID пользователя: <?=$_SESSION['user']['id']?> </h2>
    <h3 align="center">Уровень доступа: Работник отдела кадров (<?=$_SESSION['user']['lvl']?>)</h3>
    <a href="../vendor/logout.php" class="logout">Выход</a>
</form>

<?php endif; ?>
</body>
</html>
