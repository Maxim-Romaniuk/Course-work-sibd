<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';

$result = mysqli_query($connect,"SELECT staff_list_id, department_name, position_name, number_of_staff_units, salary, bonus FROM  staff_list inner join position using (position_id) inner join department using (department_id)");


?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Штатное расписание</title>
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
                        <li><a href="add_worker_profile.php">Добавить работника</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Отчеты</a>
                    <ul>
                        <li><a href="dep_workers.php">Работники отдела</a></li>
                        <li><a href="all_workers_print.php">Все действующие сотрудники</a></li>
                        <li><a href="pensioners_list_print.php">Работающие пенсионеры</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Другое</a>
                    <ul>
                        <li><a href="specialty_list.php">Список спецальностей</a></li>
                        <li><a href="#">Штатное расписание</a>
                            <ul>
                                <li><a href="staff_list_list.php">Просмотреть</a></li>
                                <li><a href="add_staff_list.php">Добавить запись</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Должности и отделы</a>
                            <ul>
                                <li><a href="position_list.php">Список должностей</a></li>
                                <li><a href="add_position.php">Добавить должность</a></li>
                                <li><a href="department_list.php">Список отделов</a></li>
                                <li><a href="add_department.php">Добавить отдел</a></li>
                            </ul>
                        </li>
                        <li><a href="disability_list.php">Список инвалидов</a></li>
                        <li><a href="military_list.php">Список военнообязанных</a></li>
                        <li><a href="pensioners_list.php">Список работающих пенсионеров</a></li>
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
        <h1 style="margin-bottom: 20px;" >Штатное расписание</h1>
        <?php
        if ($_SESSION['add_spec_msg']) {
            echo '<p class="msg"> ' . $_SESSION['add_spec_msg'] . ' </p>';
        }
        unset($_SESSION['add_spec_msg']);
        ?>
        <h3 style="float: left">Поиск:</h3><input style="position: relative; top:+11px; width: 200px" type="text" placeholder="ID или название должности, название отдела" id="search-text" onkeyup="tableSearch()">
        <table id="spec-table">
            <tr> <th width="50px">ID</th> <th width="300px">Отдел</th> <th width="300px">Должность</th> <th width="100px">Количество ставок</th> <th width="100px">Зарплата</th> <th width="100px">Премия</th> <th width="100px">Редактировать</th> </tr>
            <?php
            while($pos=mysqli_fetch_assoc($result)){ ?>
                <tr> <td width="50px"><?= $pos['staff_list_id']?></td> <td width="300px"><?= $pos['department_name']?></td> <td width="300px"><?= $pos['position_name']?></td> <td width="100px"><?= $pos['number_of_staff_units']?></td> <td width="100px"><?= $pos['salary']?></td> <td width="100px"><?= $pos['bonus']?></td> <td><a href="edit_staff_list.php?id=<?=$pos['staff_list_id']?>">Редактировать</a></td></tr>
                <?php
            }
            ?>
        </table>
    </section>
    <footer>
        <p style="text-align: center; padding-top: 15px ">СиБД. Романюк Максим. 2020</p>
    </footer>
</div>
<script>function tableSearch() {
        var phrase = document.getElementById('search-text');
        var table = document.getElementById('spec-table');
        var regPhrase = new RegExp(phrase.value, 'i');
        var flag = false;
        for (var i = 1; i < table.rows.length; i++) {
            flag = false;
            for (var j = 0; j <= table.rows[i].cells.length - 1; j++) {
                flag = regPhrase.test(table.rows[i].cells[j].innerHTML);
                if (flag) break;
            }
            if (flag) {
                table.rows[i].style.display = "";
            } else {
                table.rows[i].style.display = "none";
            }

        }
    }</script>
</body>

</html>