<?php

session_start();
require_once 'connect.php';

$pos_id= $_POST['pos_id_del'];

if(mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM personnel_department.staff_list where position_id=$pos_id"))>0):
        $_SESSION['upd_msg'] = 'Должность связана со штатным расписанием. Ошибка!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php else:
$del_pos = mysqli_query($connect, "DELETE FROM personnel_department.position where position_id=$pos_id");

if ($del_pos==1) :
    $_SESSION['add_spec_msg'] = 'Должность удалена!';?>
    <meta http-equiv="refresh" content='0; url="../pages/hr/position_list.php"'>
<?php else :
    $_SESSION['upd_msg'] = 'Ошибка удаления должности, возможно, она связана со штатным расписанием!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif;endif;  ?>
