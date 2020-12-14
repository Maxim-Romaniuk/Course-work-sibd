<?php

session_start();
require_once 'connect.php';

$worker_id = $_POST['worker_id'];
$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$family_status = $_POST['family_status'];
$department_id = $_POST['department_id'];
$position_id = $_POST['position_id'];
$work_start_date = $_POST['work_start_date'];
$work_end_date = $_POST['work_end_date'];
$article = $_POST['article'];
$identification_number = $_POST['identification_number'];
$passport_number = $_POST['passport_number'];
$date_of_issue = $_POST['date_of_issue'];
$date_of_expiry = $_POST['date_of_expiry'];
$authority = $_POST['authority'];
$registration_address = $_POST['registration_address'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$home = $_POST['home'];
$mail = $_POST['mail'];
$mil_check = $_POST['mil_check'];
$registration_type = $_POST['registration_type'];
$dis_check = $_POST['dis_check'];
$disability_group = $_POST['disability_group'];
$disability_id = $_POST['disability_id'];
$number_of_staff_units = $_POST['number_of_staff_units'];



/*Проверки*/
if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT staff_list_id FROM staff_list where position_id='$position_id' AND department_id='$department_id'"))>0) :
    print_r($staff_list_id = mysqli_fetch_assoc(mysqli_query($connect,"SELECT staff_list_id FROM staff_list where position_id=$position_id AND department_id=$department_id"))['staff_list_id']);
else:
    $_SESSION['upd_msg'] = 'Запись в штатном расписании не существует!'; ?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">

<?php die();  endif;



/*Редактирование таблиц*/

$edit_worker = mysqli_query($connect, "UPDATE worker SET surname='$surname', name='$name', patronymic='$patronymic', birthday='$birthday', 
                  family_status='$family_status', gender='$gender', registration_address='$registration_address', address='$address' where worker_id=$worker_id");
$edit_passport = mysqli_query($connect, "UPDATE passport SET identification_number='$identification_number', passport_number='$passport_number', 
                    date_of_issue='$date_of_issue', date_of_expiry='$date_of_expiry', authority='$authority' where worker_id=$worker_id");
$edit_work_history = mysqli_query($connect, "UPDATE work_history SET staff_list_id=$staff_list_id, work_start_date='$work_start_date', 
                    work_end_date='$work_end_date', article='$article', number_of_staff_units=$number_of_staff_units where worker_id=$worker_id");

if ( isset($_POST['mil_check']) == true ) {
    if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT registration_id FROM military_registration where worker_id=$worker_id"))>0){
        mysqli_query($connect, "UPDATE military_registration SET registration_type='$registration_type' where worker_id=$worker_id");
    }else{
        mysqli_query($connect, "INSERT INTO military_registration(worker_id, registration_type) VALUES ($worker_id, '$registration_type')");
    }
}else{
    if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT registration_id FROM military_registration where worker_id=$worker_id"))>0){
        mysqli_query($connect, "DELETE FROM military_registration where  worker_id=$worker_id");
    }
}

if ( isset($_POST['dis_check']) == true ) {
    if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT disability_id FROM disability where worker_id=$worker_id"))>0){
        mysqli_query($connect, "UPDATE disability SET disability_group=$disability_group, disability_id=$disability_id where worker_id=$worker_id");
    }else{
        mysqli_query($connect, "INSERT INTO disability(disability_id, worker_id, disability_group) VALUES ($disability_id, $worker_id, $disability_group)");
    }
}else{
    if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT disability_id FROM disability where worker_id=$worker_id"))>0){
        mysqli_query($connect, "DELETE FROM disability where  worker_id=$worker_id");
    }
}

if($mobile!="") {
    if (mysqli_fetch_assoc(mysqli_query($connect, "SELECT contact FROM contact where worker_id=$worker_id AND contact_type='мобильный телефон' ")) > 0) {
        mysqli_query($connect, "UPDATE contact SET contact=$mobile where worker_id=$worker_id AND contact_type='мобильный телефон'");
    } else {
        mysqli_query($connect, "INSERT INTO contact(contact_type, contact, worker_id) VALUES ('мобильный телефон', '$mobile' ,$worker_id)");
    }
}else{
    mysqli_query($connect, "DELETE FROM contact where worker_id=$worker_id AND contact_type='мобильный телефон'");
}



if($home!="") {
    if (mysqli_fetch_assoc(mysqli_query($connect, "SELECT contact FROM contact where worker_id=$worker_id AND contact_type='домашний телефон' ")) > 0) {
        mysqli_query($connect, "UPDATE contact SET contact=$home where worker_id=$worker_id AND contact_type='домашний телефон'");
    } else {
        mysqli_query($connect, "INSERT INTO contact(contact_type, contact, worker_id) VALUES ('домашний телефон', '$home' ,$worker_id)");
    }
}else{
    mysqli_query($connect, "DELETE FROM contact where worker_id=$worker_id AND contact_type='домашний телефон'");
}

if($mail!="") {
    if (mysqli_fetch_assoc(mysqli_query($connect, "SELECT contact FROM contact where worker_id=$worker_id AND contact_type='e-mail' ")) > 0) {
        mysqli_query($connect, "UPDATE contact SET contact=$mobile where worker_id=$worker_id AND contact_type='e-mail'");
    } else {
        mysqli_query($connect, "INSERT INTO contact(contact_type, contact, worker_id) VALUES ('e-mail', '$mail' ,$worker_id)");
    }
}else{
    mysqli_query($connect, "DELETE FROM contact where worker_id=$worker_id AND contact_type='e-mail'");
}


unset($_POST['worker_id']);
unset($_POST['surname']);
unset($_POST['name']);
unset($_POST['patronymic']);
unset($_POST['birthday']);
unset($_POST['gender']);
unset($_POST['family_status']);
unset($_POST['department_id']);
unset($_POST['position_id']);
unset($_POST['work_start_date']);
unset($_POST['work_end_date']);
unset($_POST['article']);
unset($_POST['identification_number']);
unset($_POST['passport_number']);
unset($_POST['date_of_issue']);
unset($_POST['date_of_expiry']);
unset($_POST['authority']);
unset($_POST['registration_address']);
unset($_POST['address']);
unset($_POST['mobile']);
unset($_POST['home']);
unset($_POST['mail']);
unset($_POST['mil_check']);
unset($_POST['registration_type']);
unset($_POST['dis_check']);
unset($_POST['disability_group']);
unset($_POST['disability_id']);

$_SESSION['upd_msg'] = 'Запись обновлена!'; ?>
<meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">

?>

