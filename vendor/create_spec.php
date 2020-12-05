<?php

session_start();
require_once 'connect.php';

$spec_code = $_POST['spec_code'];
$spec_name= $_POST['spec_name'];

if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT specialty_code FROM specialty where specialty_code='$spec_code'"))>0){
    $_SESSION['add_spec_msg'] = 'Специальность с такои кодом уже существует!'; ?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
    <?php
    die(); }

$add_spec = mysqli_query($connect, "INSERT INTO specialty(specialty_code, specialty_name) VALUES ('$spec_code', '$spec_name')");

if ($add_spec==1) :
    $_SESSION['add_spec_msg'] = 'Специальнсоть добавлена!';?>
    <meta http-equiv="refresh" content='0; url="../pages/admin/specialty_list.php"'>
<?php else :
    $_SESSION['add_spec_msg'] = 'Ошибка добавления специальности, попробуйте еще раз!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif; ?>
