<?php

session_start();
require_once 'connect.php';

$dep_id= $_POST['dep_id_del'];

if(mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM personnel_department.staff_list where department_id=$dep_id"))>0):
        $_SESSION['upd_msg'] = 'Отдел связан со штатным расписанием. Ошибка!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php else:
$del_pos = mysqli_query($connect, "DELETE FROM personnel_department.department where department_id=$dep_id");

if ($del_pos==1) :
    $_SESSION['add_spec_msg'] = 'Отдел удален!';?>
    <meta http-equiv="refresh" content='0; url="../pages/hr/department_list.php"'>
<?php else :
    $_SESSION['upd_msg'] = 'Ошибка удаления отдела, возможно, он связан со штатным расписанием!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif;endif;  ?>
