<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
$worker_id=$_GET['id'];
$worker_info = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM worker_info where worker_id=$worker_id"));
$contacts = mysqli_query($connect,"SELECT contact, contact_type FROM contact where worker_id=$worker_id order by contact_type");
$edu = mysqli_query($connect,"SELECT document_id,document_type,year_of_graduation,specialty_name FROM education inner join specialty using (specialty_code) where worker_id=$worker_id");
$gender = mysqli_query($connect,"SELECT distinct gender FROM  worker");
$family_status = mysqli_query($connect,"SELECT distinct family_status FROM  worker");
$contact_mob = mysqli_fetch_assoc(mysqli_query($connect,"SELECT contact, contact_type FROM contact where worker_id=$worker_id AND contact_type='мобильный телефон'"));
$contact_dom = mysqli_fetch_assoc(mysqli_query($connect,"SELECT contact, contact_type FROM contact where worker_id=$worker_id AND contact_type='домашний телефон'"));
$contact_email=  mysqli_fetch_assoc(mysqli_query($connect,"SELECT contact, contact_type FROM contact where worker_id=$worker_id AND contact_type='e-mail'"));
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование работника</title>
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
                        <li><a href="staff_list_list.php">Штатное расписание</a>
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
        <h1 style="margin-bottom: 10px;" >Редактирование данных работника:</h1>
        <h2 style="margin-bottom: 20px;" ><?=$worker_info['inits']?> (ID:<?=$worker_info['worker_id']?>)<a href="add_education.php?id=<?=$worker_id?>" style="text-decoration: none; color: #050f88">Добавить документ об образовании</a></h2>
        <?php
        if ($_SESSION['upd_msg']) {
            echo '<p class="msg"> ' . $_SESSION['upd_msg'] . ' </p>';
        }
        unset($_SESSION['upd_msg']);
        ?>
        <form action="../../vendor/edit_worker.php" method="post">
            <input hidden id="worker_id" name="worker_id" value="<?=$worker_info['worker_id']?>">
            <h3 style= "width: 100%; margin-bottom: 10px;">Личная информация</h3>
            <label for="surname">Фамилия *</label>
            <input type="text" placeholder="Введите фамилию" name="surname" id="surname" autocomplete="off" required value="<?=$worker_info['surname']?>">
            <label for="name">Имя *</label>
            <input type="text" placeholder="Введите имя" name="name" id="name" autocomplete="off" required value="<?=$worker_info['name']?>" >
            <label for="patronymic">Отчество *</label>
            <input type="text" placeholder="Введите отчество" name="patronymic" id="patronymic" autocomplete="off" value="<?=$worker_info['patronymic']?>">
            <label for="birthday">Дата рождения *</label>
            <input type="date" id="birthday" name="birthday" required value="<?=$worker_info['birthday']?>">
            <label for="gender">Пол *</label>
            <select id="gender" name="gender" required>
                <?php
                while($gend=mysqli_fetch_assoc($gender)){ ?>
                    <?php if($gend["gender"]!=$worker_info["gender"]): ?>
                        <option value='<?=$gend["gender"];?>'><?=$gend["gender"];?></option>
                    <?php else: ?>
                        <option selected value='<?=$gend["gender"];?>'><?=$gend["gender"];?></option>
                    <?php endif;} ?>
            </select>
            <label for="family_status">Семейное положение *</label>
            <select id="family_status" name="family_status" required>
                <?php
                while($f_s=mysqli_fetch_assoc($family_status)){ ?>
                    <?php if($f_s["family_status"]!=$worker_info["family_status"]): ?>
                        <option value='<?=$f_s["family_status"];?>'><?=$f_s["family_status"];?></option>
                    <?php else: ?>
                        <option selected value='<?=$f_s["family_status"];?>'><?=$f_s["family_status"];?></option>
                    <?php endif;} ?>
            </select>
            <h3 style= "width: 100%; margin-bottom: 10px;">Сведения о работе</h3>
            <label for="department_id">Отдел *</label>
            <select id="department_id" name="department_id" required>
                <?php
                $department = mysqli_query($connect,"SELECT * FROM  department");

                while($dep=mysqli_fetch_assoc($department)){ ?>
                    <?php if($dep["department_name"]!=$worker_info["department_name"]): ?>
                        <option value='<?=$dep["department_id"];?>'><?=$dep["department_name"];?></option>
                    <?php else: ?>
                        <option selected value='<?=$dep["department_id"];?>'><?=$dep["department_name"];?></option>
                    <?php endif;} ?>
            </select>
            <label for="position_id">Должность *</label>
            <select id="position_id" name="position_id" required>
                <?php
                $position = mysqli_query($connect,"SELECT * FROM  position");

                while($pos=mysqli_fetch_assoc($position)){ ?>
                    <?php if($pos["position_name"]!=$worker_info["position_name"]): ?>
                        <option value='<?=$pos["position_id"];?>'><?=$pos["position_name"];?></option>
                    <?php else: ?>
                        <option selected value='<?=$pos["position_id"];?>'><?=$pos["position_name"];?></option>
                    <?php endif;} ?>
            </select>

            <label for="number_of_staff_units">Количество рабочих ставок *</label>
            <input type="text" placeholder="Введите количество ставок" name="number_of_staff_units" id="number_of_staff_units" autocomplete="off" required value="<?=$worker_info['number_of_staff_units']?>">

            <label for="work_start_date">Дата начала работы *</label>
            <input id="work_start_date" name="work_start_date" type="date" required value="<?=$worker_info['work_start_date']?>">
            <label for="work_end_date">Дата окончания работы</label>
            <input id="work_end_date" name="work_end_date" type="date" value="<?=$worker_info['work_end_date']?>">
            <label for="article">Статья увольнения:</label>
            <select id="article" name="article" required>
                <?php if($worker_info["article"]!=NULL): ?>
                    <option value='NULL'><?="Выберите статью увольнения"?></option>
                <?php else: ?>
                    <option selected value='NULL'><?="Выберите статью увольнения"?></option>
                <?php endif; ?>

                <?php if($worker_info["article"]!=17): ?>
                    <option value='17'><?="17"?></option>
                <?php else: ?>
                    <option selected value='17'><?="17"?></option>
                <?php endif; ?>

                <?php if($worker_info["article"]!=29): ?>
                    <option value='29'><?="29"?></option>
                <?php else: ?>
                    <option selected value='29'><?="29"?></option>
                <?php endif; ?>

                <?php if($worker_info["article"]!=37): ?>
                    <option value='37'><?="37"?></option>
                <?php else: ?>
                    <option selected value='37'><?="37"?></option>
                <?php endif; ?>

                <?php if($worker_info["article"]!=40): ?>
                    <option value='40'><?="40"?></option>
                <?php else: ?>
                    <option selected value='40'><?="40"?></option>
                <?php endif; ?>

                <?php if($worker_info["article"]!=41): ?>
                    <option value='41'><?="41"?></option>
                <?php else: ?>
                    <option selected value='41'><?="41"?></option>
                <?php endif; ?>

                <?php if($worker_info["article"]!=42): ?>
                    <option value='42'><?="42"?></option>
                <?php else: ?>
                    <option selected value='42'><?="42"?></option>
                <?php endif; ?>

                <?php if($worker_info["article"]!=44): ?>
                    <option value='44'><?="44"?></option>
                <?php else: ?>
                    <option selected value='44'><?="44"?></option>
                <?php endif; ?>

            </select>

            <h3 style= "width: 100%; margin-bottom: 10px;">Паспортные данные</h3>
            <label for="identification_number">Идентификационный номер *</label>
            <input type="text" placeholder="Введите идентификационный номер" name="identification_number" id="identification_number" autocomplete="off" required value="<?=$worker_info['identification_number']?>" >
            <label for="passport_number">Номер паспорта *</label>
            <input type="text" placeholder="Введите нормер паспорта" name="passport_number" id="passport_number" autocomplete="off" required value="<?=$worker_info['passport_number']?>" >
            <label for="date_of_issue">Дата выдачи *</label>
            <input id="date_of_issue" name="date_of_issue" type="date" required value="<?=$worker_info['date_of_issue']?>">
            <label for="date_of_expiry">Срок действия *</label>
            <input id="date_of_expiry" name="date_of_expiry" type="date" required value="<?=$worker_info['date_of_expiry']?>">
            <label for="authority">Кем выдан *</label>
            <input type="text" placeholder="Введите орган, выдавший паспорт" name="authority" id="authority" autocomplete="off" required value="<?=$worker_info['authority']?>" >
            <label for="registration_address">Адрес прописки *</label>
            <input type="text" placeholder="Введите адрес прописки" name="registration_address" id="registration_address" autocomplete="off" required value="<?=$worker_info['registration_address']?>" >
            <label for="address">Адрес проживания *</label>
            <input type="text" placeholder="Введите адрес проживания" name="address" id="address" autocomplete="off" required value="<?=$worker_info['address']?>" >

            <h3 style= "width: 100%; margin-bottom: 10px;">Контактные данные</h3>
            <label for="mobile">Вариант связи 1 (мобильный телефон)</label>
            <input type="text" placeholder="Введите мобильный телефон в формате 375ххYYYYYYY" name="mobile" id="mobile" autocomplete="off"  value="<?=$contact_mob['contact']?>">
            <label for="home">Вариант связи 2 (домашний телефон)</label>
            <input type="text" placeholder="Введите домашний телефон в формате 375ххYYYYYYY" name="home" id="home" autocomplete="off"  value="<?=$contact_dom['contact']?>">
            <label for="mail">Вариант связи 3 (e-mail)</label>
            <input type="text" placeholder="Введите адрес электронной почты" name="mail" id="mail" autocomplete="off"  value="<?=$contact_email['contact']?>">


            <h3 style= "width: 100%; margin-bottom: 10px;">Особые отметки</h3>

            <?php if( mysqli_fetch_assoc(mysqli_query($connect,"SELECT registration_type FROM military_registration where worker_id=$worker_id"))>0): ?>
                <label><input type="checkbox" checked name="mil_check"/> Воинский учет
                    <select id="registration_type" name="registration_type" required>
                        <?php if($worker_info["registration_type"]!=NULL): ?>
                            <option value='NULL'><?="Выберите тип воинского учета"?></option>
                        <?php else: ?>
                            <option selected value='NULL'><?="Выберите тип воинского учета"?></option>
                        <?php endif; ?>

                        <?php if($worker_info["registration_type"]!="военнообязанный"): ?>
                            <option value='военнообязанный'><?="военнообязанный"?></option>
                        <?php else: ?>
                            <option selected value='военнообязанный'><?="военнообязанный"?></option>
                        <?php endif; ?>

                        <?php if($worker_info["registration_type"]!="призывник"): ?>
                            <option value='призывник'><?="призывник"?></option>
                        <?php else: ?>
                            <option selected value='призывник'><?="призывник"?></option>
                        <?php endif; ?>
                    </select></label>
            <?php else: ?>
            <label><input type="checkbox" name="mil_check"/> Воинский учет
                <select id="registration_type" name="registration_type" required>
                    <?php if($worker_info["registration_type"]!=NULL): ?>
                        <option value='NULL'><?="Выберите тип воинского учета"?></option>
                    <?php else: ?>
                        <option selected value='NULL'><?="Выберите тип воинского учета"?></option>
                    <?php endif; ?>

                    <?php if($worker_info["registration_type"]!="военнообязанный"): ?>
                        <option value='военнообязанный'><?="военнообязанный"?></option>
                    <?php else: ?>
                        <option selected value='военнообязанный'><?="военнообязанный"?></option>
                    <?php endif; ?>

                    <?php if($worker_info["registration_type"]!="призывник"): ?>
                        <option value='призывник'><?="призывник"?></option>
                    <?php else: ?>
                        <option selected value='призывник'><?="призывник"?></option>
                    <?php endif;endif; ?>
                </select></label>

            <?php if( mysqli_fetch_assoc(mysqli_query($connect,"SELECT disability_group FROM disability where worker_id=$worker_id"))>0): ?>
                <label><input type="checkbox" checked name="dis_check"/> Инвалидность
                    <select id="disability_group" name="disability_group" required>
                        <?php if($worker_info["disability_group"]!=NULL): ?>
                            <option value='NULL'><?="Выберите группу инвалидности"?></option>
                        <?php else: ?>
                            <option selected value='NULL'><?="Выберите группу инвалидности"?></option>
                        <?php endif; ?>

                        <?php if($worker_info["disability_group"]!=1): ?>
                            <option value=1><?="1 группа"?></option>
                        <?php else: ?>
                            <option selected value=1><?="1 группа"?></option>
                        <?php endif; ?>

                        <?php if($worker_info["disability_group"]!=2): ?>
                            <option value=2><?="2 группа"?></option>
                        <?php else: ?>
                            <option selected value=2><?="2 группа"?></option>
                        <?php endif; ?>

                        <?php if($worker_info["disability_group"]!=3): ?>
                            <option value=3><?="3 группа"?></option>
                        <?php else: ?>
                            <option selected value=3><?="3 группа"?></option>
                        <?php endif; ?>
                    </select>
                    <?php if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT disability_id FROM disability where worker_id=$worker_id"))>0):?>
                        <input type="text" placeholder="Номер удостоверения" name="disability_id" id="disability_id" autocomplete="off" value="<?=mysqli_fetch_assoc(mysqli_query($connect,"SELECT disability_id FROM disability where worker_id=$worker_id"))['disability_id']?>">

                    <?php else: ?>
                        <input type="text" placeholder="Номер удостоверения" name="disability_id" id="disability_id" autocomplete="off">
                    <?php endif; ?>
                </label>
            <?php else: ?>
            <label><input type="checkbox" name="dis_check"/> Инвалидность
                <select id="disability_group" name="disability_group" required>
                    <?php if($worker_info["disability_group"]!=NULL): ?>
                        <option value='NULL'><?="Выберите группу инвалидности"?></option>
                    <?php else: ?>
                        <option selected value='NULL'><?="Выберите группу инвалидности"?></option>
                    <?php endif; ?>

                    <?php if($worker_info["disability_group"]!=1): ?>
                        <option value=1><?="1 группа"?></option>
                    <?php else: ?>
                        <option selected value=1><?="1 группа"?></option>
                    <?php endif; ?>

                    <?php if($worker_info["disability_group"]!=2): ?>
                        <option value=2><?="2 группа"?></option>
                    <?php else: ?>
                        <option selected value=2><?="2 группа"?></option>
                    <?php endif; ?>

                    <?php if($worker_info["disability_group"]!=3): ?>
                        <option value=3><?="3 группа"?></option>
                    <?php else: ?>
                        <option selected value=3><?="3 группа"?></option>
                    <?php endif; ?>
                </select>
                                <?php if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT disability_id FROM disability where worker_id=$worker_id"))>0):?>
                <input type="text" placeholder="Номер удостоверения" name="disability_id" id="disability_id" autocomplete="off" value="<?=mysqli_fetch_assoc(mysqli_query($connect,"SELECT disability_id FROM disability where worker_id=$worker_id"))['disability_id']?>">

                                <?php else: ?>
                <input type="text" placeholder="Номер удостоверения" name="disability_id" id="disability_id" autocomplete="off">
                                <?php endif; ?>
                <?php endif; ?>
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