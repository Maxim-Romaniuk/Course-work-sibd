<?php

session_start();
require_once 'connect.php';

$user_id = strtolower($_POST['user_id']);
$user_login = strtolower($_POST['user_login']);
$user_lvl= strtolower($_POST['user_lvl']);
if($_POST['new_user_password']!=''){
    $new_user_password = md5($_POST['new_user_password']);
    $edit_user = mysqli_query($connect, "UPDATE user SET login='$user_login', pass='$new_user_password', lvl=$user_lvl where id=$user_id");
}else{
    $edit_user = mysqli_query($connect, "UPDATE user SET login='$user_login', lvl=$user_lvl where id=$user_id");
}

if ($edit_user==1) :
    $_SESSION['upd_msg'] = 'Обновлено успешно!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php else :
    $_SESSION['upd_msg'] = 'Ошибка обновения!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif;
unset($_POST['user_id']);
unset($_POST['user_login']);
unset($_POST['user_lvl']);

?>

