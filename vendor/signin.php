<?php

session_start();
require_once '../vendor/auth.php';

$login = strtolower($_POST['login']);
$password = md5($_POST['password']);
$check_user = mysqli_query($auth, "SELECT * FROM `personnel_department`.`user` WHERE `login` = '$login' AND `pass` = '$password'");
if (mysqli_num_rows($check_user) > 0) {

    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
        "id" => $user['id'],
        "login" => $user['login'],
        "lvl" => $user['lvl'],
    ];
    if ($_SESSION['user']['lvl']==9){
        header('Location: ../profiles/profile_admin.php', true);
    } else if($_SESSION['user']['lvl']==5){
        header('Location: ../profiles/profile_hr.php', true);
    } else if($_SESSION['user']['lvl']==1){
        header('Location: ../profiles/profile_chief.php', true);
    } else{
        header('Location: ../profiles/profile_unknown.php', true);
    }


} else {
    $_SESSION['message'] = 'Не верный логин или пароль';
    header('Location: ../index.php');
}
?>

<pre>
    <?php
    print_r($check_user);
    print_r($user);
    ?>
</pre>
