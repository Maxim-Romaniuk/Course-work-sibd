<?php

session_start();
require_once 'connect.php';

$user_login = strtolower($_POST['user_login']);
$user_lvl= strtolower($_POST['user_lvl']);
$user_password= MD5($_POST['user_lvl']);

if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT login FROM user where login='$user_login'"))>0){
    $_SESSION['create_msg'] = 'Пользователь с таким именем уже существует!'; ?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
 <?php
    die(); }

    $create_user = mysqli_query($connect, "INSERT INTO user(login, pass, lvl) VALUES ('$user_login', '$user_password', $user_lvl)");

if ($create_user==1) :
    $_SESSION['create_msg'] = 'Пользователь создан!';?>
    <meta http-equiv="refresh" content='0; url="../profile.php"'>
<?php else :
    $_SESSION['create_msg'] = 'Ошибка создания пользователя, попробуйте еще раз!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif; ?>
