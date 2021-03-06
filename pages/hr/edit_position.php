<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
$id=$_GET['id'];
$pos_info = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM position where position_id='$id'"));
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование должности</title>
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
        <h1 style="margin-bottom: 20px;" >Редактирование должности</h1>
        <form action="../../vendor/edit_pos.php" method="post">
            <label for="pos_id">ID должности (нельзя изменять)</label>
            <input   type="text" name="pos_id" id="pos_id" autocomplete="off" required value="<?=$id?>" readonly>
            <label for="pos_name">Название должности *</label>
            <input  type="text" placeholder="Введите название должности" name="pos_name" id="pos_name" autocomplete="off" value="<?=$pos_info["position_name"]?>" required>

            <button style="margin-top: 25px" class="button" type="submit">Сохранить</button>

        </form>
        <form action="../../vendor/delete_pos.php" method="post">
            <input hidden required value="<?=$id?>" name="pos_id_del" id="pos_id_del">
            <button style="margin-top: 25px; background: #bc524c" class="button" type="submit" onclick="return del();">Удалить должность</button>
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