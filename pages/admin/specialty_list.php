<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
//$connect=mysqli_connect('localhost', 'login_php', 'Klu3uiop!', 'personnel_department');
//if (!$connect) {
// die('Error connect to DataBase with logins');
//}
$result = mysqli_query($connect,"SELECT specialty_code, specialty_name FROM specialty ORDER BY specialty_code");

?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Специальности</title>
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <header>
        <nav class="dws-menu">
            <ul>
                <li><a href="../../profile.php">Главная</a></li>
                <li><a href="#"><i class="fa fa-"></i>Пользователи</a>
                    <ul>
                        <li><a href="../../profile.php">Список пользователей</a></li>
                        <li><a href="create_user_profile.php">Добавить пользователя</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Специальности</a>
                    <ul>
                        <li><a href="#">Список спецальностей</a></li>
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
        <h1 style="margin-bottom: 20px;" >Список специальностей по ОКРБ</h1>
        <?php
        if ($_SESSION['add_spec_msg']) {
            echo '<p class="msg"> ' . $_SESSION['add_spec_msg'] . ' </p>';
        }
        unset($_SESSION['add_spec_msg']);
        ?>
        <h3 style="float: left">Поиск:</h3><input style="position: relative; top:-1px; width: 300px" type="text" placeholder="Код специальности или название" id="search-text" onkeyup="tableSearch()">
        <table id="spec-table">
            <tr> <th width="100px">Код специальности</th> <th width="550px">Название специальности</th> <th>Редактировать</th></tr>
            <?php
            while($spec=mysqli_fetch_assoc($result)){ ?>
                <tr> <td width="100px"><?= $spec['specialty_code']?></td> <td width="550px"><?= $spec['specialty_name']?></td> <td><a href="edit_specialty.php?code=<?= rawurlencode($spec['specialty_code'])?>"> Редактировать</a></td></tr>
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