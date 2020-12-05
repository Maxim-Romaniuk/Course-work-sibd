<?php

session_start();
require_once 'connect.php';

$user_id= $_POST['user_id_del'];


$del_user= mysqli_query($connect, "DELETE FROM user where id='$user_id'");

if ($del_user==1) :
    $_SESSION['create_msg'] = 'Пользователь удален!';?>
    <meta http-equiv="refresh" content="0; url='../profile.php' ?>">
<?php else :
    $_SESSION['create_msg'] = 'Ошибка удаления!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif;
unset($_POST['user_id']);


?>

