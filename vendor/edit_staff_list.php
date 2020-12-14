<?php

session_start();
require_once 'connect.php';

$s_l_id = $_POST['s_l_id'];
$pos_id = $_POST['pos_id'];
$dep_id = $_POST['dep_id'];
$n_staff_units= $_POST['n_staff_units'];
$salary = $_POST['salary'];
$bonus = $_POST['bonus'];

    $edit_s_l = mysqli_query($connect, "UPDATE staff_list SET position_id='$pos_id', department_id='$dep_id', number_of_staff_units='$n_staff_units', salary='$salary', bonus='$bonus' where staff_list_id='$s_l_id'");

if ($edit_s_l==1) :
    $_SESSION['upd_msg'] = 'Обновлено успешно!';
    unset($_POST['s_l_id']);
    unset($_POST['pos_id']);
    unset($_POST['dep_id']);
    unset($_POST['n_staff_units']);
    unset($_POST['salary']);
    unset($_POST['bonus']);?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">

<?php else :
    $_SESSION['upd_msg'] = 'Ошибка обновения!';
    unset($_POST['s_l_id']);
    unset($_POST['pos_id']);
    unset($_POST['dep_id']);
    unset($_POST['n_staff_units']);
    unset($_POST['salary']);
    unset($_POST['bonus']);?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif;


?>

