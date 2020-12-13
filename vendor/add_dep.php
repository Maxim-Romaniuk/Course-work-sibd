<?php

session_start();
require_once 'connect.php';

$dep_name= $_POST['dep_name'];

if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM department where department_name='$dep_name'"))>0){
    $_SESSION['add_spec_msg'] = 'Отдел с таким названием уже существет!'; ?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
    <?php
    die(); }

$add_pos = mysqli_query($connect, "INSERT INTO personnel_department.department(department_name) VALUES ('$dep_name')");

if ($add_pos==1) :
    $_SESSION['add_spec_msg'] = 'Отдел добавлен!';?>
    <meta http-equiv="refresh" content='0; url="../pages/hr/department_list.php"'>
<?php else :
    $_SESSION['add_spec_msg'] = 'Ошибка добавления отдела, попробуйте еще раз!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif; ?>
