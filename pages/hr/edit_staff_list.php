<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
$id=$_GET['id'];
$staff_list_info = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM  staff_list inner join position using (position_id) inner join department using (department_id) where staff_list_id='$id'"));
$position = mysqli_query($connect, "SELECT * FROM position");
$department = mysqli_query($connect, "SELECT * FROM department");
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование штатной единицы</title>
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
        <h1 style="margin-bottom: 20px;" >Редактирование шататного расписания</h1>
        <form action="../../vendor/edit_staff_list.php" method="post">
            <label for="s_l_id">ID должности (нельзя изменять)</label>
            <input   type="text" name="s_l_id" id="s_l_id" autocomplete="off" required value="<?=$id?>" readonly>
            <label for="pos_id">Название должности *</label>
            <select id="pos_id" name="pos_id" required>
                <?php
                while($pos=mysqli_fetch_assoc($position)){ ?>
                    <?php if($pos["position_name"]!=$staff_list_info["position_name"]): ?>
                        <option value='<?=$pos["position_id"];?>'><?=$pos["position_name"];?></option>
                    <?php else: ?>
                        <option selected value='<?=$pos["position_id"];?>'><?=$pos["position_name"];?></option>
                    <?php endif;} ?>
            </select>
            <label for="dep_id">Название отдела *</label>
            <select id="dep_id" name="dep_id" required>
                <?php
                while($dep=mysqli_fetch_assoc($department)){ ?>
                    <?php if($dep["department_name"]!=$staff_list_info["department_name"]): ?>
                        <option value='<?=$dep["department_id"];?>'><?=$dep["department_name"];?></option>
                    <?php else: ?>
                        <option selected value='<?=$dep["department_id"];?>'><?=$dep["department_name"];?></option>
                    <?php endif;} ?>
            </select>
            <label for="n_staff_units">Количество ставок *</label>
            <input  type="text" placeholder="Введите количество ставок" name="n_staff_units" id="n_staff_units" autocomplete="off" value="<?=$staff_list_info["number_of_staff_units"]?>" required>
            <label for="salary">Зарплата *</label>
            <input  type="text" placeholder="Введите размер зарплаты" name="salary" id="salary" autocomplete="off" value="<?=$staff_list_info["salary"]?>" required>
            <label for="bonus">Премия *</label>
            <input  type="text" placeholder="Введите размер премии" name="bonus" id="bonus" autocomplete="off" value="<?=$staff_list_info["bonus"]?>" required>



            <button style="margin-top: 25px" class="button" type="submit">Сохранить</button>

        </form>
        <form action="../../vendor/delete_staff_list.php" method="post">
            <input hidden required value="<?=$id?>" name="s_l_id_del" id="s_l_id_del">
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