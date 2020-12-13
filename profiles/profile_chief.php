<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once 'vendor/connect.php';
include 'vendor/db_print.php';
//$connect=mysqli_connect('localhost', 'login_php', 'Klu3uiop!', 'personnel_department');
//if (!$connect) {
// die('Error connect to DataBase with logins');
//}
$result = mysqli_query($connect,"SELECT id, login, lvl_name FROM user inner join levels using(lvl) ORDER BY id");

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
                <li><a href="#"><i class="fa fa-"></i>Пользователи</a>
                    <ul>
                        <li><a href="#">Список пользователей</a></li>
                        <li><a href="pages/admin/create_user_profile.php">Добавить пользователя</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Специальности</a>
                    <ul>
                        <li><a href="pages/admin/specialty_list.php">Список спецальностей</a></li>
                        <li><a href="pages/admin/add_new_specialty.php">Добавить специальность</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Профиль</a>
                    <ul>
                        <li><a href="../vendor/logout.php" class="logout">Выход</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <section class="main-content">
        <h1 style="margin-bottom: 20px;" >Список пользователей системы "Отдел кадров"</h1>
        <?php
        if ($_SESSION['create_msg']) {
            echo '<p class="msg"> ' . $_SESSION['create_msg'] . ' </p>';
        }
        unset($_SESSION['create_msg']);
        ?>
        <h3 style="float: left">Поиск:</h3><input style="position: relative; top:-1px; width: 300px" type="text" placeholder="Логин, ID или уровень доступа" id="search-text" onkeyup="tableSearch()">
        <table id="info-table">
            <tr> <th width="50px">ID</th> <th width="250px">Логин</th> <th width="300px">Уровень доступа</th> <th>Редактировать</th></tr>
            <?php
            while($user=mysqli_fetch_assoc($result)){ ?>
                <tr> <td width="50px"><?= $user['id']?></td> <td width="250px"><?= $user['login']?></td> <td width="300px"><?= mb_ucfirst($user['lvl_name'])?></td> <td><a href="pages/admin/edit_user_profile.php?id=<?= $user['id']?>"> Редактировать</a></td></tr>
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