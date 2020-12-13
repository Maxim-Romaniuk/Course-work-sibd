<?php
session_start();
$lvls = array(1,5,9);
//////КОНФИГУРАЦИЯ//////

///////////////////////

function get_rows($table, $connect) {
    $result = mysqli_query($connect,"SELECT * FROM $table");
    if (!$result){
        exit("<p>В базе данных не обнаружено таблицы проверте настройки</p>");
    }
    if(mysqli_num_rows($result) == 0) {
        exit('Зписей в таблице нет');
    }
    $row = array();
    for($i = 0; $i < mysqli_num_rows($result); $i++) {
        $row[] = mysqli_fetch_array($result);
    }
    return $row;
}
mb_internal_encoding("UTF-8");


function mb_ucfirst($text) {
    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}