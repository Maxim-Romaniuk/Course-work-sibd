<?php

session_start();
require_once 'connect.php';

$pos_id= $_POST['pos_id'];
$dep_id= $_POST['dep_id'];
$n_staff_units= $_POST['n_staff_units'];
$salary= $_POST['salary'];
$bonus= $_POST['bonus'];

if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM staff_list where position_id='$pos_id' AND department_id='$dep_id'"))>0){
    $_SESSION['add_spec_msg'] = 'Такая штатная единица уже существует!'; ?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
    <?php
    die(); }

$add_s_l = mysqli_query($connect, "INSERT INTO personnel_department.staff_list(department_id, position_id, number_of_staff_units, salary, bonus) VALUES ('$dep_id','$pos_id','$n_staff_units','$salary','$bonus')");

if ($add_s_l==1) :
    $_SESSION['add_spec_msg'] = 'Штатная единица добавлена!';?>
    <meta http-equiv="refresh" content='0; url="../pages/hr/staff_list_list.php"'>
<?php else :
    $_SESSION['add_spec_msg'] = 'Ошибка добавления штатной едицицы!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif; ?>
