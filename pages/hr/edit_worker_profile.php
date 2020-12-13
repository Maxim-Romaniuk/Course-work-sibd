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
    <section class="main-content">
        <h1 style="margin-bottom: 10px;" >Редактирование данных работника: </h1>
        <h2 style="margin-bottom: 20px;" ><?=$worker_info['inits']?> (ID:<?=$worker_info['worker_id']?>)</h2>

        <form action="../../vendor/create_user.php" method="post">
            <h3 style= "width: 100%; margin-bottom: 10px;">Личная информация</h3>
            <label for="user_login">Фамилия *</label>
            <input type="text" placeholder="Введите фамилию" name="user_login" id="user_login" autocomplete="off" required value="<?=$worker_info['surname']?> ">
            <label for="user_password">Имя *</label>
            <input type="text" placeholder="Введите имя" name="user_password" id="user_password" autocomplete="off" required value="<?=$worker_info['name']?>" >
            <label for="user_lvl">Отчество *</label>
            <input type="text" placeholder="Введите отчество" name="user_password" id="user_password" autocomplete="off" value="<?=$worker_info['patronymic']?>">
            <label for="user_lvl">Дата рождения *</label>
            <input id="date" type="date" value="<?=$worker_info['birthday']?>">
            <label for="user_lvl">Пол *</label>
            <select id="user_lvl" name="user_lvl" required>
                <?php
                while($gend=mysqli_fetch_assoc($gender)){ ?>
                    <?php if($gend["gender"]!=$worker_info["gender"]): ?>
                        <option value='<?=$gend["gender"];?>'><?=$gend["gender"];?></option>
                    <?php else: ?>
                        <option selected value='<?=$gend["gender"];?>'><?=$gend["gender"];?></option>
                    <?php endif;} ?>
            </select>
            <label for="user_lvl">Семейное положение *</label>
            <select id="user_lvl" name="user_lvl" required>
                <?php
                while($f_s=mysqli_fetch_assoc($family_status)){ ?>
                    <?php if($f_s["family_status"]!=$worker_info["family_status"]): ?>
                        <option value='<?=$f_s["family_status"];?>'><?=$f_s["family_status"];?></option>
                    <?php else: ?>
                        <option selected value='<?=$f_s["family_status"];?>'><?=$f_s["family_status"];?></option>
                    <?php endif;} ?>
            </select>
            <h3 style= "width: 100%; margin-bottom: 10px;">Сведения о работе</h3>
            <label for="user_login">Отдел *</label>
            <select id="user_lvl" name="user_lvl" required>
                <?php
                $position = mysqli_query($connect,"SELECT * FROM  position");

                while($pos=mysqli_fetch_assoc($position)){ ?>
                    <?php if($pos["position_name"]!=$worker_info["position_name"]): ?>
                        <option value='<?=$pos["position_id"];?>'><?=$pos["position_name"];?></option>
                    <?php else: ?>
                        <option selected value='<?=$pos["position_id"];?>'><?=$pos["position_name"];?></option>
                    <?php endif;} ?>
            </select>
            <label for="user_password">Должность *</label>
            <select id="user_lvl" name="user_lvl" required>
                <?php
                $department = mysqli_query($connect,"SELECT * FROM  department");

                while($dep=mysqli_fetch_assoc($department)){ ?>
                    <?php if($dep["department_name"]!=$worker_info["department_name"]): ?>
                        <option value='<?=$dep["department_name"];?>'><?=$dep["department_name"];?></option>
                    <?php else: ?>
                        <option selected value='<?=$dep["department_name"];?>'><?=$dep["department_name"];?></option>
                    <?php endif;} ?>
            </select>
            <label for="user_lvl">Дата начала работы *</label>
            <input id="date" type="date" value="<?=$worker_info['work_start_date']?>">
            <label for="user_lvl">Дата окончания работы</label>
            <input id="date" type="date" value="<?=$worker_info['work_end_date']?>">
            <label for="user_lvl">Статья увольнения:</label>
            <select id="user_lvl" name="user_lvl" required>
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
            <label for="user_login">Идентификационный номер *</label>
            <input type="text" placeholder="Введите идентификационный номер" name="user_login" id="user_login" autocomplete="off" required value="<?=$worker_info['identification_number']?> ">
            <label for="user_password">Номер паспорта *</label>
            <input type="text" placeholder="Введите нормер паспорта" name="user_password" id="user_password" autocomplete="off" required value="<?=$worker_info['passport_number']?>" >
            <label for="user_lvl">Дата выдачи *</label>
            <input id="date" type="date" value="<?=$worker_info['date_of_issue']?>">
            <label for="user_lvl">Срок действия *</label>
            <input id="date" type="date" value="<?=$worker_info['date_of_expiry']?>">
            <label for="user_lvl">Кем выдан *</label>
            <input type="text" placeholder="Введите орган, выдавший паспорт" name="user_password" id="user_password" autocomplete="off" required value="<?=$worker_info['authority']?>" >
            <label for="user_lvl">Адрес прописки *</label>
            <input type="text" placeholder="Введите адрес прописки" name="user_password" id="user_password" autocomplete="off" required value="<?=$worker_info['registration_address']?>" >
            <label for="user_lvl">Адрес проживания *</label>
            <input type="text" placeholder="Введите адрес проживания" name="user_password" id="user_password" autocomplete="off" required value="<?=$worker_info['address']?>" >

            <h3 style= "width: 100%; margin-bottom: 10px;">Контактные данные</h3>
            <label for="user_login">Вариант связи 1 (мобильный телефон) *</label>
            <input type="text" placeholder="Введите мобильный телефон в формате 375ххYYYYYYY" name="user_login" id="user_login" autocomplete="off" required value="<?=$contact_mob['contact']?> ">
            <label for="user_login">Вариант связи 2 (домашний телефон) *</label>
            <input type="text" placeholder="Введите домашний телефон в формате 375ххYYYYYYY" name="user_login" id="user_login" autocomplete="off" required value="<?=$contact_dom['contact']?> ">
            <label for="user_login">Вариант связи 3 (e-mail) *</label>
            <input type="text" placeholder="Введите адрес электронной почты" name="user_login" id="user_login" autocomplete="off" required value="<?=$contact_email['contact']?> ">


            <h3 style= "width: 100%; margin-bottom: 10px;">Особые отметки</h3>

            <?php if( mysqli_fetch_assoc(mysqli_query($connect,"SELECT registration_type FROM military_registration where worker_id=$worker_id"))>0): ?>
             <label><input type="checkbox" checked name="XXX"/> Воинский учет
                 <select id="user_lvl" name="user_lvl" required>
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
            <label><input type="checkbox" name="XXX"/> Воинский учет
                <select id="user_lvl" name="user_lvl" required>
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
                <label><input type="checkbox" checked name="YYY"/> Инвалидность
                    <select id="user_lvl" name="user_lvl" required>
                        <?php if($worker_info["disability_group"]!=NULL): ?>
                            <option value='NULL'><?="Выберите группу инвалидности"?></option>
                        <?php else: ?>
                            <option selected value='NULL'><?="Выберите тип воинского учета"?></option>
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
                    </select></label>
            <?php else: ?>
            <label><input type="checkbox" name="XXX"/> Инвалидность
                <select id="user_lvl" name="user_lvl" required>
                    <?php if($worker_info["disability_group"]!=NULL): ?>
                        <option value='NULL'><?="Выберите группу инвалидности"?></option>
                    <?php else: ?>
                        <option selected value='NULL'><?="Выберите тип воинского учета"?></option>
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
                    <?php endif; endif;?>
                </select></label>



            <button style="margin-top: 25px" class="button" type="submit">Обновить данные</button>
        </form>
    </section>
    <footer>
        <p style="text-align: center; padding-top: 15px ">СиБД. Романюк Максим. 2020</p>
    </footer>
</div>
</body>
</html>