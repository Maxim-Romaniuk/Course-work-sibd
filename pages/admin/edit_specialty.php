<?php
header("Content-Type:text/html;charset=UTF-8");
//подключаем файл конфигурации
require_once '../../vendor/connect.php';
include '../../vendor/db_print.php';
$code=rawurldecode($_GET['code']);
$spec_info = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM specialty where specialty_code='$code'"));
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
        <h1 style="margin-bottom: 20px;" >Редактирование специальности</h1>
        <form action="../../vendor/edit_spec.php" method="post">
            <label for="spec_code">Код специальности (нельзя изменять)</label>
            <input   type="text" name="spec_code" id="spec_code" autocomplete="off" required value="<?=$code?>" readonly>
            <label for="spec_name">Название специальности *</label>
            <textarea style="font-size: 15px" placeholder="Введите название специальности" name="spec_name" id="spec_name" autocomplete="off" required><?=$spec_info["specialty_name"]?></textarea>

            <button style="margin-top: 25px" class="button" type="submit">Сохранить</button>

        </form>
        <form action="../../vendor/delete_spec.php" method="post">
            <input hidden required value="<?=$code?>" name="spec_code_del" id="spec_code_del">
            <button style="margin-top: 25px; background: #bc524c" class="button" type="submit" onclick="return del();">Удалить специальность</button>
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
        if (confirm("Bы уверены, что хотите удалить эту специальность?"))
            return true;
        else return false;
    }
</script>
</body>
</html>