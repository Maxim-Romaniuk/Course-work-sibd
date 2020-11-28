<?php

$auth = mysqli_connect('localhost', 'login_php', 'Klu3uiop', 'personnel_department');

if (!$auth) {
    die('Error connect to DataBase with logins');
}