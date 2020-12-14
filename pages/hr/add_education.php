<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
$worker_id=$_GET['id'];
$specialty = mysqli_query($connect, "SELECT * FROM specialty");
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
        <h1 style="margin-bottom: 20px;">Добавление документа об образовании</h1>
        <?php
        if ($_SESSION['add_spec_msg']) {
            echo '<p class="msg"> ' . $_SESSION['add_spec_msg'] . ' </p>';
        }
        unset($_SESSION['add_spec_msg']);
        ?>
        <form action="../../vendor/add_edu.php" method="post">

            <label for="doc_id">Номер документа об образовании *</label>
            <input  type="text" placeholder="Введите номер документа" name="doc_id" id="doc_id" autocomplete="off" required>

            <label for="doc_type">Тип документа об образовании *</label>
            <select id="doc_type" name="doc_type" required>
                        <option value='свидетельство об общем базовом образовании'>свидетельство об общем базовом образовании</option>
                        <option value='аттестат об общем среднем образовании'>аттестат об общем среднем образовании</option>
                        <option value='диплом о профессионально-техническом образовании'>диплом о профессионально-техническом образовании</option>
                        <option value='диплом о среднем специальном образовании'>диплом о среднем специальном образовании</option>
                        <option value='диплом о высшем образовании'>диплом о высшем образовании</option>
                        <option value='диплом магистра'>диплом магистра</option>
                        <option value='диплом исследователя'>диплом исследователя</option>
                        <option value='диплом о переподготовке на уровне среднего специального образования'>диплом о переподготовке на уровне среднего специального образования</option>
                        <option value='диплом о переподготовке на уровне высшего образования'>диплом о переподготовке на уровне высшего образования</option>
                        <option value='свидетельство о повышении квалификации'>свидетельство о повышении квалификации</option>
            </select>
            <label for="grad_year">Год выпуска *</label>
            <input type="number" min="1940" max="2099" step="1" id="grad_year" name="grad_year">
            <label for="spec_code">Код специальности *</label>
            <select id="spec_code" name="spec_code" required>
                <?php
                while($code=mysqli_fetch_assoc($specialty)){ ?>
                        <option value='<?=$code["specialty_code"];?>'><?=$code["specialty_code"].' '.$code["specialty_name"];?></option>
                <?php } ?>
            </select>
            <input id="id" name="id" value="<?=$worker_id?>" hidden>

            <button style="margin-top: 25px" class="button" type="submit">Добавить</button>
        </form>
    </section>
    <footer>
        <p style="text-align: center; padding-top: 15px ">СиБД. Романюк Максим. 2020</p>
    </footer>
</div>
</body>
</html>