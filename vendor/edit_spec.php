<?php

session_start();
require_once 'connect.php';

$spec_code = $_POST['spec_code'];
$spec_name = $_POST['spec_name'];

    $edit_spec = mysqli_query($connect, "UPDATE specialty SET specialty_name='$spec_name' where specialty_code='$spec_code'");

if ($edit_spec==1) :
    $_SESSION['upd_msg'] = 'Обновлено успешно!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php else :
    $_SESSION['upd_msg'] = 'Ошибка обновения!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif;
unset($_POST['spec_code']);
unset($_POST['spec_name']);


?>

