<?php
session_start()
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

<form>
    <h1 align="center">Добро пожаловать, <?=$_SESSION['user']['login']?>! </h1>
    <h2 align="center">Ваш ID пользователя: <?=$_SESSION['user']['id']?> </h2>
    <h3 align="center">Уровень доступа: Нет прав (<?=$_SESSION['user']['lvl']?>)</h3>
    <a href="../vendor/logout.php" class="logout">Выход</a>
</form>

</p>
</body>
</html>