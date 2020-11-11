<?php

session_start();
require_once '../vendor/connect.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$check_user = mysqli_query($connect, "SELECT * FROM `users`.`login` WHERE `login` = '$login' AND `pass` = '$password'");
if (mysqli_num_rows($check_user) > 0) {

    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
        "id" => $user['id'],
        "login" => $user['login'],
        "stat" => $user['stat'],
    ];

    header('Location: ../profile.php');

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
