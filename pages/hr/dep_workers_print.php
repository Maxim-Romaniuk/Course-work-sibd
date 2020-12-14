<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
//$connect=mysqli_connect('localhost', 'login_php', 'Klu3uiop!', 'personnel_department');
//if (!$connect) {
// die('Error connect to DataBase with logins');
//}
$department_id = $_GET['id'];
$result = mysqli_query($connect,"select worker_id, concat_ws(' ',surname, name, patronymic) as fio, birthday,
       position_name, department_name, family_status, (salary+bonus)*work_history.number_of_staff_units as zarp
from worker inner join work_history 
using(worker_id) inner join staff_list using(staff_list_id) inner join position 
using(position_id) inner join department using(department_id) where department_id=$department_id and work_end_date is NULL ORDER BY worker_id");

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
       <section class="main-content">
        <h1 style="margin-bottom: 20px;" >Список работников: <?=mysqli_fetch_assoc(mysqli_query($connect, "SELECT department_name from department where department_id=$department_id"))['department_name'] ?> на <?=date("d.m.Y") ?></h1>

        <h3 style="float: left">Поиск:</h3><input style="position: relative; top:-1px; width: 200px" type="text" placeholder="ID или название должности" id="search-text" onkeyup="tableSearch()">
        <table id="spec-table">
            <tr> <th width="50px">ID</th> <th width="350px">ФИО</th> <th width="100px">Дата рождения</th> <th width="250px">Семейное положение</th> <th width  <th width="200px">Должность</th><th width="200px">Зарплата и премия</th></tr>
            <?php
            while($pos=mysqli_fetch_assoc($result)){ ?>
                <tr> <td width="50px"><?= $pos['worker_id']?></td> <td width="350px"><?= $pos['fio']?></td>  <td width="100px"><?= $pos['birthday']?></td> <td width="250px"><?= $pos['family_status']?></td> <td width="200px"><?= $pos['position_name']?></td><td width="200px"><?= $pos['zarp']?></td></tr>
                <?php
            }
            ?>
        </table>
    </section>

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
<script>
    window.print();
    setTimeout(function(){
        window.history.back()
    }, 500);
</script>
</html>