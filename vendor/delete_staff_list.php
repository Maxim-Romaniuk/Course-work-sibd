<?php

session_start();
require_once 'connect.php';

$s_l_id= $_POST['s_l_id_del'];

if(mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM personnel_department.work_history where staff_list_id=$s_l_id"))>0):
        $_SESSION['upd_msg'] = 'Запись связана с трудовой историей. Ошибка!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php else:
$del_pos = mysqli_query($connect, "DELETE FROM personnel_department.staff_list where staff_list_id=$s_l_id");

if ($del_pos==1) :
    $_SESSION['add_spec_msg'] = 'Штатная единица удалена!';?>
    <meta http-equiv="refresh" content='0; url="../pages/hr/staff_list_list.php"'>
<?php else :
    $_SESSION['upd_msg'] = 'Ошибка удаления!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif;endif;  ?>
