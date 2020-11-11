<?php

$connect = mysqli_connect('localhost', 'admin', 'admin', 'users');

if (!$connect) {
    die('Error connect to DataBase');
}