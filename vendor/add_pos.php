<?php

session_start();
require_once 'connect.php';

$pos_name= $_POST['pos_name'];

if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM position where position_name='$pos_name'"))>0){
    $_SESSION['add_spec_msg'] = 'Должность с таким названием уже существет!'; ?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
    <?php
    die(); }

$add_pos = mysqli_query($connect, "INSERT INTO personnel_department.position(position_name) VALUES ('$pos_name')");

if ($add_pos==1) :
    $_SESSION['add_spec_msg'] = 'Должность добавлена!';?>
    <meta http-equiv="refresh" content='0; url="../pages/hr/position_list.php"'>
<?php else :
    $_SESSION['add_spec_msg'] = 'Ошибка добавления должности, попробуйте еще раз!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif; ?>
