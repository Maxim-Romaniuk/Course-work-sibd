<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
$id=$_GET['id'];
$dep_info = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM department where department_id='$id'"));
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
        <h1 style="margin-bottom: 20px;" >Редактирование отдела</h1>
        <form action="../../vendor/edit_dep.php" method="post">
            <label for="dep_id">ID должности (нельзя изменять)</label>
            <input   type="text" name="dep_id" id="dep_id" autocomplete="off" required value="<?=$id?>" readonly>
            <label for="dep_name">Название отдела *</label>
            <input  type="text" placeholder="Введите название отдела" name="dep_name" id="dep_name" autocomplete="off" value="<?=$dep_info["department_name"]?>" required>

            <button style="margin-top: 25px" class="button" type="submit">Сохранить</button>

        </form>
        <form action="../../vendor/delete_dep.php" method="post">
            <input hidden required value="<?=$id?>" name="dep_id_del" id="dep_id_del">
            <button style="margin-top: 25px; background: #bc524c" class="button" type="submit" onclick="return del();">Удалить отдел</button>
            <?php
            if ($_SESSION['upd_msg']) {
                echo '<p class="msg"> ' . $_SESSION['upd_msg'] . ' </p>';
            }
            unset($_SESSION['upd_msg']);
            ?>
</form>
    </section>
    <footer>
        <p style="text-align: center; padding-top: 15px ">СиБД. Романюк Максим. 2020</p>
    </footer>
</div>
<script type="text/javascript">
    function del()
    {
        if (confirm("Bы уверены, что хотите удалить эту должность?"))
            return true;
        else return false;
    }
</script>
</body>
</html>