<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
//$connect=mysqli_connect('localhost', 'login_php', 'Klu3uiop!', 'personnel_department');
//if (!$connect) {
// die('Error connect to DataBase with logins');
//}
$result = mysqli_query($connect,"SELECT department_id, department_name FROM department ORDER BY department_id");

?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отделы</title>
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
                        <li><a href="dep_workers.php">Работники отдела</a></li>
                        <li><a href="all_workers_print.php">Все действующие сотрудники</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Другое</a>
                    <ul>
                        <li><a href="specialty_list.php">Список специальностей</a></li>
                        <li><a href="staff_list_list.php">Штатное расписание</a></li>
                        <li><a href="position_list.php">Список должностей</a></li>
                        <li><a href="#">Список отделов</a></li>

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
        <h1 style="margin-bottom: 20px;" >Список отделов</h1>
        <?php
        if ($_SESSION['add_spec_msg']) {
            echo '<p class="msg"> ' . $_SESSION['add_spec_msg'] . ' </p>';
        }
        unset($_SESSION['add_spec_msg']);
        ?>
        <h3 style="float: left">Поиск:</h3><input style="position: relative; top:-1px; width: 200px" type="text" placeholder="ID или название отдела" id="search-text" onkeyup="tableSearch()">
        <table id="spec-table">
            <tr> <th width="100px">ID</th> <th width="850px">Название отдела</th> </tr>
            <?php
            while($dep=mysqli_fetch_assoc($result)){ ?>
                <tr> <td width="100px"><?= $dep['department_id']?></td> <td width="850px"><?= $dep['department_name']?></td> </tr>
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