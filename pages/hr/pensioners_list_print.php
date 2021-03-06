<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
//$connect=mysqli_connect('localhost', 'login_php', 'Klu3uiop!', 'personnel_department');
//if (!$connect) {
// die('Error connect to DataBase with logins');
//}
$result = mysqli_query($connect,"select worker_id, concat_ws(' ',surname, name, patronymic) as fio, gender, birthday,
       ((YEAR(CURRENT_DATE)-YEAR(`birthday`))-(RIGHT(CURRENT_DATE,5)<RIGHT(`birthday`,5))) as age, position_name, department_name
from worker inner join work_history 
using(worker_id) inner join staff_list using(staff_list_id) inner join position 
using(position_id) inner join department using(department_id) where 
((gender='женский' AND ((YEAR(CURRENT_DATE)-YEAR(`birthday`))-(RIGHT(CURRENT_DATE,5)<RIGHT(`birthday`,5)))>=57) 
OR (gender='мужской' AND ((YEAR(CURRENT_DATE)-YEAR(`birthday`))-(RIGHT(CURRENT_DATE,5)<RIGHT(`birthday`,5)))>=62)) AND work_end_date is NULL ORDER BY department_name");

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
        <h1 style="margin-bottom: 20px;" >Список работающих пенсионеров на <?=date("d.m.Y") ?></h1>

        <h3 style="float: left">Поиск:</h3><input style="position: relative; top:-1px; width: 200px" type="text" placeholder="ID или название должности" id="search-text" onkeyup="tableSearch()">
        <table id="spec-table">
            <tr> <th width="50px">ID</th> <th width="350px">ФИО</th> <th width="100px">Пол</th> <th width="100px">Дата рождения</th> <th width="100px">Возраст</th> <th width="200px">Отдел</th> <th width="200px">Должность</th></tr>
            <?php
            while($pos=mysqli_fetch_assoc($result)){ ?>
                <tr> <td width="50px"><?= $pos['worker_id']?></td> <td width="350px"><?= $pos['fio']?></td> <td width="100px"><?= $pos['gender']?></td> <td width="100px"><?= $pos['birthday']?></td> <td width="100px"><?= $pos['age']?></td> <td width="200px"><?= $pos['department_name']?></td> <td width="200px"><?= $pos['position_name']?></td></tr>
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