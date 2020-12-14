<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';

$departments = mysqli_query($connect,"SELECT * FROM  department");


?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отчет "Работники отдела"</title>
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <header>
        <nav class="dws-menu">
            <ul>
                <li><a href="../../profile.php"><i class="fa fa-"></i>Главная</a></li>
                <li><a href="../../profile.php"><i class="fa fa-"></i>Работники</a>
                    <ul>
                        <li><a href="../../profile.php">Список работников</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Отчеты</a>
                    <ul>
                        <li><a href="#">Работники отдела</a></li>
                        <li><a href="all_workers_print.php">Все действующие сотрудники</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Другое</a>
                    <ul>
                        <li><a href="specialty_list.php">Список специальностей</a></li>
                        <li><a href="staff_list_list.php">Штатное расписание</a></li>
                        <li><a href="position_list.php">Список должностей</a></li>
                        <li><a href="department_list.php">Список отделов</a></li>

                    </ul>
                </li>

                <li><a href="#"><i class="fa fa-"></i>Профиль</a>
                    <ul>
                        <li><a href="../../vendor/logout.php" class="logout">Выход</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>      <section class="main-content">
        <h1 style="margin-bottom: 20px;" >Создание отчета со списком работников в отделе</h1>
        <form action="dep_workers_print.php" method="get">
            <label for="id">Выберите отдел *</label>
            <select id="id" name="id" required>
                <option selected>Выберите отдел</option>
                <?php
                while($dep=mysqli_fetch_assoc($departments)){ ?>
                    <option value='<?= $dep["department_id"]?>'><?= $dep["department_name"];?></option>
                <?php } ?>
            </select>

            <button style="margin-top: 25px" class="button" type="submit">Создать отчет</button>
        </form>
    </section>
    <footer>
        <p style="text-align: center; padding-top: 15px ">СиБД. Романюк Максим. 2020</p>
    </footer>
</div>
</body>
</html>