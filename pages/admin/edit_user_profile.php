<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
$user_id=$_GET['id'];
$user_info = mysqli_fetch_assoc(mysqli_query($connect,"SELECT login, lvl FROM user where id=$user_id"));
$levels = mysqli_query($connect,"SELECT lvl, lvl_name FROM  levels");
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
                <li><a href="../../profile.php">Главная</a></li>
                <li><a href="#">Пользователи</a>
                    <ul>
                        <li><a href="../../profile.php">Список пользователей</a></li>
                        <li><a href="create_user_profile.php">Добавить пользователя</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-"></i>Специальности</a>
                    <ul>
                        <li><a href="specialty_list.php">Список спецальностей</a></li>
                        <li><a href="add_new_specialty.php">Добавить специальность</a></li>
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
        <h1 style="margin-bottom: 20px;" >Редактирование пользователя системы "Отдел кадров"</h1>
        <form action="../../vendor/edit_user.php" method="post">
            <label for="user_id">ID пользователя (нельзя изменять)</label>
            <input   type="text" name="user_id" id="user_id" autocomplete="off" required value="<?= $_GET['id'] ?>" readonly>
            <label for="user_login">Логин *</label>
            <input type="text" placeholder="Введите логин" name="user_login" id="user_login" autocomplete="off" value="<?= $user_info["login"] ?>" required>
            <label for="new_user_password">Новый пароль</label>
            <input type="password" placeholder="Введите новый пароль" name="new_user_password" id="new_user_password" autocomplete="off">
            <label for="user_lvl">Уровень доступа:</label>
            <select id="user_lvl" name="user_lvl" required>
                <?php
                while($lvl=mysqli_fetch_assoc($levels)){ ?>
                    <?php if($lvl["lvl"]!=$user_info["lvl"]): ?>
                        <option value='<?= $lvl["lvl"];?>'><?= $lvl["lvl_name"];?></option>
                    <?php else: ?>
                        <option selected value='<?= $lvl["lvl"]?>'><?= $lvl["lvl_name"];?></option>
                    <?php endif;} ?>
            </select>
            <button style="margin-top: 25px" class="button" type="submit">Сохранить</button>
            <?php
            if ($_SESSION['upd_msg']) {
                echo '<p class="msg"> ' . $_SESSION['upd_msg'] . ' </p>';
            }
            unset($_SESSION['upd_msg']);
            ?>
        </form>
        <form action="../../vendor/delete_user.php" method="post">
            <input hidden required value="<?=$user_id?>" name="user_id_del" id="user_id_del">
            <button style="margin-top: 25px; background: #bc524c" class="button" type="submit" onclick="return del();">Удалить пользователя</button>
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
        if (confirm("Bы уверены, что хотите удалить этого пользователя?"))
            return true;
        else return false;
    }
</script>
</body>
</html>