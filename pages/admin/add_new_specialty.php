<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление специальности</title>
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
                        <li><a href="create_user_profile.php">Добавить пользователя</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Специальности</a>
                    <ul>
                        <li><a href="specialty_list.php">Список спецальностей</a></li>
                        <li><a href="#">Добавить специальность</a></li>
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
        <h1 style="margin-bottom: 20px;" >Добавление новой специальности</h1>
        <?php
        if ($_SESSION['add_spec_msg']) {
            echo '<p class="msg"> ' . $_SESSION['add_spec_msg'] . ' </p>';
        }
        unset($_SESSION['add_spec_msg']);
        ?>
        <form action="../../vendor/create_spec.php" method="post">
            <label for="spec_code">Код специальности *</label>
            <input   placeholder="Введите код специальности" type="text" name="spec_code" id="spec_code" autocomplete="off" required>
            <label for="spec_name">Название специальности *</label>
            <textarea style="font-size: 15px" placeholder="Введите название специальности" name="spec_name" id="spec_name" autocomplete="off" required></textarea>

            <button style="margin-top: 25px" class="button" type="submit">Добавить специальность</button>
        </form>
    </section>
    <footer>
        <p style="text-align: center; padding-top: 15px ">СиБД. Романюк Максим. 2020</p>
    </footer>
</div>
</body>
</html>