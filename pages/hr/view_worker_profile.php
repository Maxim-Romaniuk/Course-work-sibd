<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
$date_now = new DateTime("now");
$worker_id=$_GET['id'];
$worker_info = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM worker_info where worker_id=$worker_id"));
$worker_age = mysqli_fetch_assoc(mysqli_query($connect, "SELECT (YEAR(CURRENT_DATE)-YEAR(`birthday`))-(RIGHT(CURRENT_DATE,5)<RIGHT(`birthday`,5)) as age FROM worker where worker_id=$worker_id"));
$staff_units = $worker_info['number_of_staff_units'];
$contacts = mysqli_query($connect,"SELECT contact, contact_type FROM contact where worker_id=$worker_id order by contact_type");
$edu = mysqli_query($connect,"SELECT document_id,document_type,year_of_graduation,specialty_name FROM education inner join specialty using (specialty_code) where worker_id=$worker_id");

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
                <li><a href="#"><i class="fa fa-"></i>Главная</a></li>
                <li><a href="#"><i class="fa fa-"></i>Работники</a>
                    <ul>
                        <li><a href="#">Список работников</a></li>
                        <li><a href="#">Добавить работника</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Отчеты</a>
                    <ul>
                        <li><a href="#">Работники отдела</a></li>
                        <li><a href="#">Все действующие сотрудники</a></li>
                        <li><a href="#">Работающие пенсионеры</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Другое</a>
                    <ul>
                        <li><a href="#">Список спецальностей</a></li>
                        <li><a href="#">Штатное расписание</a>
                            <ul>
                                <li><a href="#">Просмотреть</a></li>
                                <li><a href="#">Добавить запись</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Должности и отделы</a>
                            <ul>
                                <li><a href="#">Список должностей</a></li>
                                <li><a href="#">Добавить должность</a></li>
                                <li><a href="#">Список отделов</a></li>
                                <li><a href="#">Добавить отдел</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Список инвалидов</a></li>
                        <li><a href="#">Список военнообязанных</a></li>
                        <li><a href="#">Список работающих пенсионеров</a></li>
                    </ul>
                </li>
                <li><a href="#">Расширенный поиск</a></li>

                <li><a href="#"><i class="fa fa-"></i>Профиль</a>
                    <ul>
                        <li><a href="../../vendor/logout.php" class="logout">Выход</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <section class="main-content" style="min-width: 1100px">
        <h1 style="margin-bottom: 10px;" >Подробная информация о работнике:</h1>
        <h2 style="margin-bottom: 20px;" ><?=$worker_info['inits']?> (ID:<?=$worker_info['worker_id']?>) <a href="edit_worker_profile.php?id=<?=$worker_id?>" style="text-decoration: none; color: #050f88">Редактировать данные</a></h2>
        <h3 style= "margin-bottom: 10px;">Личная информация</h3>
        <p style="margin-bottom: 5px"><b>ФИО: </b> <?=$worker_info['fio']?> </p>
        <p style="margin-bottom: 5px"><b>Дата рождения: </b><?=date("d.m.Y",strtotime($worker_info['birthday']))?> (<?=$worker_age["age"]?> лет)</p>
        <p style="margin-bottom: 5px"><b>Пол: </b><?=$worker_info['gender']?></p>
        <p style="margin-bottom: 5px"><b>Семейное положение: </b><?=$worker_info['family_status']?></p>
        <div class="line"></div>
        <h3 style= "margin-bottom: 10px;">Сведения о работе</h3>
        <p style="margin-bottom: 5px"><b>Отдел: </b><?=$worker_info['department_name']?></p>
        <p style="margin-bottom: 5px"><b>Должность: </b><?=$worker_info['position_name']?></p>
        <p style="margin-bottom: 5px"><b>Количество ставок: </b><?=$staff_units?></p>
        <p style="margin-bottom: 5px"><b>Зарплата: </b><?=$worker_info['salary']*$staff_units?></p>
        <p style="margin-bottom: 5px"><b>Премия: </b><?=$worker_info['bonus']?></p>
        <p style="margin-bottom: 5px"><b>Дата начала работы: </b><?=date("d.m.Y", strtotime($worker_info['work_start_date']))?></p>
        <?php if ($worker_info['work_end_date']!=NULL){
            echo("<p style='margin-bottom: 5px'><b>Дата окончания работы: </b>". date("d.m.Y", strtotime($worker_info['work_end_date'])). "</p>");
            echo("<p style='margin-bottom: 5px'><b>Статья увольнения: </b>". $worker_info['article']. "</p>");

        }?>

        <div class="line"></div>
        <h3 style= "margin-bottom: 10px;">Паспортные данные:</h3>
        <p style="margin-bottom: 5px"><b>Идентификационный номер: </b> <?=$worker_info['identification_number']?></p>
        <p style="margin-bottom: 5px"><b>Номер паспорта: </b><?=$worker_info['passport_number']?></p>
        <p style="margin-bottom: 5px"><b>Дата выдачи: </b><?=date("d.m.Y", strtotime($worker_info['date_of_issue']))?></p>
        <p style="margin-bottom: 5px"><b>Срок действия: </b><?=date("d.m.Y", strtotime($worker_info['date_of_expiry']))?></p>
        <p style="margin-bottom: 5px"><b>Кем выдан: </b><?=$worker_info['authority']?></p>
        <p style="margin-bottom: 5px"><b>Адрес прописки: </b><?=$worker_info['registration_address']?></p>
        <p style="margin-bottom: 5px"><b>Адрес проживания: </b><?=$worker_info['address']?></p>

        <div class="line"></div>
        <h3 style= "margin-bottom: 10px;">Контактные данные:</h3>
        <?php $i=1;
        while($contact=mysqli_fetch_assoc($contacts)){ ?>
            <p style="margin-bottom: 5px"><b>Вариант связи <?=$i. "</b> (".$contact['contact_type']."): +".$contact['contact']?></p>
        <?php $i++;} ?>

        <div class="line"></div>
        <h3 style= "margin-bottom: 10px;">Информация об образовании:</h3>
        <?php $i=1;
        while($edu_info=mysqli_fetch_assoc($edu)){ ?>
        <p style="margin-bottom: 5px; margin-top: 10px"><b>Документ <?=$i?></b></p>
        <p style="margin-bottom: 5px"><b>Тип: </b> <?=$edu_info['document_type']?></p>
        <p style="margin-bottom: 5px"><b>Номер документа: </b><?=$edu_info['document_id']?></p>
        <p style="margin-bottom: 5px"><b>Специальность: </b><?=$edu_info['specialty_name']?></p>
        <p style="margin-bottom: 5px"><b>Год выпуска: </b><?=$edu_info['year_of_graduation']?></p>
        <?php $i++;} ?>

        <div class="line"></div>
        <h3 style= "margin-bottom: 10px;">Особые отметки:</h3>
        <p style="margin-bottom: 5px"><b>Воинский учет: </b> <?php if ($worker_info['registration_type']==NULL){
                                                echo ("не состоит");}else{echo ($worker_info['registration_type']);};?></p>
        <p style="margin-bottom: 5px"><b>Инвалидность: </b><?php if ($worker_info['disability_group']==NULL){
                echo ("не является инвалидом");}else{echo ($worker_info['disability_group'])." группа";};?></p>

    </section>
    <footer>
        <p style="text-align: center; padding-top: 15px ">СиБД. Романюк Максим. 2020</p>
    </footer>
</div>
</body>
</html>