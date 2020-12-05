<?php
session_start();
if ($_SESSION['user']['lvl'] == 9) {
    $connect = mysqli_connect('localhost', 'admin_user', 'S!aNdmin', 'personnel_department');
    if (!$connect) {
        die('1');
    }
} elseif ($_SESSION['user']['lvl'] == 5) {
    $connect = mysqli_connect('localhost', 'hr_user', 'RnThrsi!', 'personnel_department');
    if (!$connect) {
        die('2');
    }
} elseif ($_SESSION['user']['lvl'] == 1) {
    $connect = mysqli_connect('localhost', 'chief_user', 'Ch13f!fg', 'personnel_department');
    if (!$connect) {
        die('3');
    }
} else {
    die('4');
}