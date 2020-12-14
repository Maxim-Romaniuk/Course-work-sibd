<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once 'vendor/connect.php';
include 'vendor/db_print.php';
//$connect=mysqli_connect('localhost', 'login_php', 'Klu3uiop!', 'personnel_department');
//if (!$connect) {
// die('Error connect to DataBase with logins');
//}
$query = "select worker_id, concat_ws(' ',surname, name, patronymic) as fio, birthday, position_name, department_name
from worker inner join work_history 
using(worker_id) inner join staff_list using(staff_list_id) inner join position 
using(position_id) inner join department using(department_id) ORDER BY worker_id";
$result = mysqli_query($connect,$query);

?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <header>
        <nav class="dws-menu">
            <ul>
                <li><a href="#"><i class="fa fa-"></i>Главная</a></li>
                <li><a href="#"><i class="fa fa-"></i>Работники</a>
                    <ul>
                        <li><a href="#">Список работников</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Отчеты</a>
                    <ul>
                        <li><a href="pages/chief/dep_workers.php">Работники отдела</a></li>
                        <li><a href="pages/chief/all_workers_print.php">Все действующие сотрудники</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Другое</a>
                    <ul>
                        <li><a href="pages/chief/specialty_list.php">Список специальностей</a></li>
                        <li><a href="pages/chief/staff_list_list.php">Штатное расписание</a></li>
                        <li><a href="pages/chief/position_list.php">Список должностей</a></li>
                        <li><a href="pages/chief/department_list.php">Список отделов</a></li>

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
        <h1 style="margin-bottom: 20px;" >Список работников в базе</h1>
        <?php
        if ($_SESSION['create_msg']) {
            echo '<p class="msg"> ' . $_SESSION['create_msg'] . ' </p>';
        }
        unset($_SESSION['create_msg']);
        ?>
        <h3 style="float: left">Поиск:</h3><input style="position: relative; top:-1px; width: 300px" type="text" placeholder="ФИО, дата рождения, отдел, должность" id="search-text" onkeyup="tableSearch()">
        <table id="info-table">
            <tr> <th width="300px">ФИО</th><th width="150px">Дата рождения</th> <th width="300px">Отдел</th> <th width="300px">Должность</th> <th>Подробнее</th></tr>
            <?php
            while($worker=mysqli_fetch_assoc($result)){ ?>
                <tr> <td width="300px"><?=$worker['fio']?></td> <td width="150px"><?=date("d.m.Y",strtotime($worker['birthday']))?></td> <td width="300px"><?= mb_ucfirst($worker['department_name'])?></td> <td width="300px"><?= mb_ucfirst($worker['position_name'])?></td> <td><a href="pages/chief/view_worker_profile.php?id=<?= $worker['worker_id']?>">Подробнее</a></td></tr>
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
        var table = document.getElementById('info-table');
        var regPhrase = new RegExp(phrase.value, 'i');
        var flag = false;
        for (var i = 1; i < table.rows.length; i++) {
            flag = false;
            for (var j = 0; j <= table.rows[i].cells.length - 2; j++) {
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