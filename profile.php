<?php
session_start();
$lvls = array(1,5,9);
if ($_SESSION['user']['lvl']==9):
   require('profiles/profile_admin.php');
elseif ($_SESSION['user']['lvl']==5):
    require('profiles/profile_hr.php');
elseif ($_SESSION['user']['lvl']==1):
    require('profiles/profile_chief.php');
elseif ( isset($_SESSION['user']) && !in_array($_SESSION['user']['lvl'], $lvls)):
    require('profiles/profile_unknown.php');
else: ?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>

    <h1 align='center'>Ошибка! Неоходимо авторизоваться<br>Через 5 секунд произойдет переадресация на страницу входа</h1>
    <meta http-equiv="refresh" content="5; url=index.php">
</body>
</html>

<?php endif; ?>