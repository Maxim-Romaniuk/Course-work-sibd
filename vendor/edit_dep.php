<?php

session_start();
require_once 'connect.php';

$dep_id = $_POST['dep_id'];
$dep_name = $_POST['dep_name'];

    $edit_dep = mysqli_query($connect, "UPDATE department SET department_name='$dep_name' where department_id='$dep_id'");

if ($edit_dep==1) :
    $_SESSION['upd_msg'] = 'Обновлено успешно!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php else :
    $_SESSION['upd_msg'] = 'Ошибка обновения!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif;
unset($_POST['pos_id']);
unset($_POST['pos_name']);


?>

