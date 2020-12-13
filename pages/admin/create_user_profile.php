<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
$levels = mysqli_query($connect,"SELECT lvl, lvl_name FROM  levels");
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <header>
        <nav class="dws-menu">
            <ul>
                <li><a href="../../profile.php">Главная</a></li>
                <li><a href="#">Пользователи</a>
                    <ul>
                        <li><a href="../../profile.php">Список пользователей</a></li>
                        <li><a href="#">Добавить пользователя</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Специальности</a>
                    <ul>
                        <li><a href="specialty_list.php">Список спецальностей</a></li>
                        <li><a href="add_new_specialty.php">Добавить специальность</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Профиль</a>
                    <ul>
                        <li><a href="../../vendor/logout.php" class="logout">Выход</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <section class="main-content">
        <h1 style="margin-bottom: 20px;" >Cоздание пользователя системы "Отдел кадров"</h1>
        <?php
        if ($_SESSION['create_msg']) {
            echo '<p class="msg"> ' . $_SESSION['create_msg'] . ' </p>';
        }
        unset($_SESSION['create_msg']);
        ?>
        <form action="../../vendor/create_user.php" method="post">
            <label for="user_login">Логин *</label>
            <input type="text" placeholder="Введите логин" name="user_login" id="user_login" autocomplete="off" required>
            <label for="user_password">Пароль *</label>
            <input type="password" placeholder="Введите пароль" name="user_password" id="user_password" autocomplete="off" required>
            <label for="user_lvl">Уровень доступа *</label>
            <select id="user_lvl" name="user_lvl" required>
                <?php
                while($lvl=mysqli_fetch_assoc($levels)){ ?>
                     <option selected value='<?= $lvl["lvl"]?>'><?= $lvl["lvl_name"];?></option>
                <?php } ?>
            </select>
            <button style="margin-top: 25px" class="button" type="submit">Создать пользователя</button>
        </form>
    </section>
    <footer>
        <p style="text-align: center; padding-top: 15px ">СиБД. Романюк Максим. 2020</p>
    </footer>
</div>
</body>
</html>