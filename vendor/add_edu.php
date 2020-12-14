<?php

session_start();
require_once 'connect.php';

$doc_id= $_POST['doc_id'];
$doc_type= $_POST['doc_type'];
$grad_year= $_POST['grad_year'];
$spec_code= $_POST['spec_code'];
$id= $_POST['id'];

if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM education where document_id='$doc_id' AND document_type='$doc_type'"))>0){
    $_SESSION['upd_msg'] = 'Такой документ уже существует!'; ?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
    <?php
    die(); }

$add_edu = mysqli_query($connect, "INSERT INTO personnel_department.education(document_id, document_type, year_of_graduation, specialty_code, worker_id) VALUES ('$doc_id','$doc_type','$grad_year','$spec_code','$id')");

if ($add_edu==1) :
    $_SESSION['add_spec_msg'] = 'Документ добавлен!';?>
    <meta http-equiv="refresh" content='0; url="../pages/hr/view_worker_profile.php?id=<?=$id?>"'>
<?php else :
    $_SESSION['add_spec_msg'] = 'Ошибка добавления документа!';?>
    <meta http-equiv="refresh" content='0; url="../pages/hr/view_worker_profile.php?id=<?=$id?>"'>
<?php endif; ?>
