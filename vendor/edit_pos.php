<?php

session_start();
require_once 'connect.php';

$pos_id = $_POST['pos_id'];
$pos_name = $_POST['pos_name'];

    $edit_pos = mysqli_query($connect, "UPDATE position SET position_name='$pos_name' where position_id='$pos_id'");

if ($edit_pos==1) :
    $_SESSION['upd_msg'] = 'Обновлено успешно!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php else :
    $_SESSION['upd_msg'] = 'Ошибка обновения!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif;
unset($_POST['pos_id']);
unset($_POST['pos_name']);


?>

