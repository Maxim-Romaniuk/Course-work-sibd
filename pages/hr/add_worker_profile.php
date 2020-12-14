<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';

$gender = mysqli_query($connect,"SELECT distinct gender FROM  worker");
$family_status = mysqli_query($connect,"SELECT distinct family_status FROM  worker");


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

                <li><a href="#"><i class="fa fa-"></i>Профиль</a>
                    <ul>
                        <li><a href="../../vendor/logout.php" class="logout">Выход</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <section class="main-content">
        <h1 style="margin-bottom: 10px;" >Добавление работника:
        </h1>
        <?php
        if ($_SESSION['upd_msg']) {
            echo '<p class="msg"> ' . $_SESSION['upd_msg'] . ' </p>';
        }
        unset($_SESSION['upd_msg']);
        ?>
        <form action="../../vendor/add_worker.php" method="post">
            <h3 style= "width: 100%; margin-bottom: 10px;">Личная информация</h3>
            <label for="surname">Фамилия *</label>
            <input type="text" placeholder="Введите фамилию" name="surname" id="surname" autocomplete="off" required ?>
            <label for="name">Имя *</label>
            <input type="text" placeholder="Введите имя" name="name" id="name" autocomplete="off" required ?>
            <label for="patronymic">Отчество *</label>
            <input type="text" placeholder="Введите отчество" name="patronymic" id="patronymic" autocomplete="off" ?>
            <label for="birthday">Дата рождения *</label>
            <input type="date" id="birthday" name="birthday" required">
            <label for="gender">Пол *</label>
            <select id="gender" name="gender" required>
                <?php
                while($gend=mysqli_fetch_assoc($gender)){ ?>
                        <option value='<?=$gend["gender"];?>'><?=$gend["gender"];?></option>
                    <?php } ?>
            </select>
            <label for="family_status">Семейное положение *</label>
            <select id="family_status" name="family_status" required>
                <?php
                while($f_s=mysqli_fetch_assoc($family_status)){ ?>
                        <option selected value='<?=$f_s["family_status"];?>'><?=$f_s["family_status"];?></option>
                    <?php } ?>
            </select>
            <h3 style= "width: 100%; margin-bottom: 10px;">Сведения о работе</h3>
            <label for="department_id">Отдел *</label>
            <select id="department_id" name="department_id" required>
                <?php
                $department = mysqli_query($connect,"SELECT * FROM  department");

                while($dep=mysqli_fetch_assoc($department)){ ?>
                        <option selected value='<?=$dep["department_id"];?>'><?=$dep["department_name"];?></option>
                    <?php } ?>
            </select>
            <label for="position_id">Должность *</label>
            <select id="position_id" name="position_id" required>
                <?php
                $position = mysqli_query($connect,"SELECT * FROM  position");

                while($pos=mysqli_fetch_assoc($position)){ ?>
                        <option selected value='<?=$pos["position_id"];?>'><?=$pos["position_name"];?></option>
                    <?php } ?>
            </select>

            <label for="number_of_staff_units">Количество рабочих ставок *</label>
            <input type="text" placeholder="Введите количество ставок" name="number_of_staff_units" id="number_of_staff_units" autocomplete="off" required>

            <label for="work_start_date">Дата начала работы *</label>
            <input id="work_start_date" name="work_start_date" type="date" required >

            <h3 style= "width: 100%; margin-bottom: 10px;">Паспортные данные</h3>
            <label for="identification_number">Идентификационный номер *</label>
            <input type="text" placeholder="Введите идентификационный номер" name="identification_number" id="identification_number" autocomplete="off" required >
            <label for="passport_number">Номер паспорта *</label>
            <input type="text" placeholder="Введите нормер паспорта" name="passport_number" id="passport_number" autocomplete="off" required >
            <label for="date_of_issue">Дата выдачи *</label>
            <input id="date_of_issue" name="date_of_issue" type="date" required >
            <label for="date_of_expiry">Срок действия *</label>
            <input id="date_of_expiry" name="date_of_expiry" type="date" required >
            <label for="authority">Кем выдан *</label>
            <input type="text" placeholder="Введите орган, выдавший паспорт" name="authority" id="authority" autocomplete="off" required >
            <label for="registration_address">Адрес прописки *</label>
            <input type="text" placeholder="Введите адрес прописки" name="registration_address" id="registration_address" autocomplete="off" required  >
            <label for="address">Адрес проживания *</label>
            <input type="text" placeholder="Введите адрес проживания" name="address" id="address" autocomplete="off" required  >

            <h3 style= "width: 100%; margin-bottom: 10px;">Контактные данные</h3>
            <label for="mobile">Вариант связи 1 (мобильный телефон)</label>
            <input type="text" placeholder="Введите мобильный телефон в формате 375ххYYYYYYY" name="mobile" id="mobile" autocomplete="off"  >
            <label for="home">Вариант связи 2 (домашний телефон)</label>
            <input type="text" placeholder="Введите домашний телефон в формате 375ххYYYYYYY" name="home" id="home" autocomplete="off"  >
            <label for="mail">Вариант связи 3 (e-mail)</label>
            <input type="text" placeholder="Введите адрес электронной почты" name="mail" id="mail" autocomplete="off"  >


            <h3 style= "width: 100%; margin-bottom: 10px;">Особые отметки</h3>

                <label><input type="checkbox"  name="mil_check"/> Воинский учет
                    <select id="registration_type" name="registration_type" required>
                            <option selected value='NULL'><?="Выберите тип воинского учета"?></option>
                            <option value='военнообязанный'><?="военнообязанный"?></option>
                            <option value='призывник'><?="призывник"?></option>
                    </select></label>

                <label><input type="checkbox"  name="dis_check"/> Инвалидность
                    <select id="disability_group" name="disability_group" required>
                            <option selected value='NULL'><?="Выберите группу инвалидности"?></option>
                            <option value=1><?="1 группа"?></option>
                            <option value=2><?="2 группа"?></option>
                            <option value=3><?="3 группа"?></option>
                    </select>
                        <input type="text" placeholder="Номер удостоверения" name="disability_id" id="disability_id" autocomplete="off" >
                </label>

            <button style="margin-top: 25px" class="button" type="submit">Обновить данные</button>
        </form>
    </section>
    <footer>
        <p style="text-align: center; padding-top: 15px ">СиБД. Романюк Максим. 2020</p>
    </footer>
</div>
</body>
</html>