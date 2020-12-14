<?php

session_start();
require_once 'connect.php';

print_r($surname = $_POST['surname']);
print_r($name = $_POST['name']);
print_r($patronymic = $_POST['patronymic']);
print_r($birthday = $_POST['birthday']);
print_r($gender = $_POST['gender']);
print_r($family_status = $_POST['family_status']);
print_r($department_id = $_POST['department_id']);
print_r($position_id = $_POST['position_id']);
print_r($work_start_date = $_POST['work_start_date']);
print_r($identification_number = $_POST['identification_number']);
print_r($passport_number = $_POST['passport_number']);
print_r($date_of_issue = $_POST['date_of_issue']);
print_r($date_of_expiry = $_POST['date_of_expiry']);
print_r($authority = $_POST['authority']);
print_r($registration_address = $_POST['registration_address']);
print_r($address = $_POST['address']);
print_r($mobile = $_POST['mobile']);
print_r($home = $_POST['home']);
print_r($mail = $_POST['mail']);
print_r($mil_check = $_POST['mil_check']);
print_r($registration_type = $_POST['registration_type']);
print_r($dis_check = $_POST['dis_check']);
print_r($disability_group = $_POST['disability_group']);
print_r($disability_id = $_POST['disability_id']);
print_r($number_of_staff_units = $_POST['number_of_staff_units']);



/*Проверки*/
if(mysqli_fetch_assoc(mysqli_query($connect,"SELECT staff_list_id FROM staff_list where position_id='$position_id' AND department_id='$department_id'"))>0) :
    print_r($staff_list_id = mysqli_fetch_assoc(mysqli_query($connect,"SELECT staff_list_id FROM staff_list where position_id=$position_id AND department_id=$department_id"))['staff_list_id']);
else:
    $_SESSION['upd_msg'] = 'Запись в штатном расписании не существует!'; ?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">

<?php die();  endif;



/*Редактирование таблиц*/

$add_worker = mysqli_query($connect, "INSERT INTO worker(surname, name, patronymic, birthday, family_status, gender, registration_address, address)  
                    VALUES ('$surname', '$name', '$patronymic', '$birthday', '$family_status', '$gender', '$registration_address', '$address')");
if($add_worker!=1){
    $_SESSION['upd_msg'] = 'Ошибка добавления пользователя!'; ?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
    <?php die();}

$worker_id=mysqli_fetch_assoc(mysqli_query($connect, "SELECT worker_id from worker order by worker_id DESC"))['worker_id'];

$add_passport = mysqli_query($connect, "INSERT INTO passport(worker_id, identification_number, passport_number, date_of_issue, date_of_expiry, authority) 
VALUES ($worker_id, '$identification_number', '$passport_number', '$date_of_issue', '$date_of_expiry', '$authority')");
if($add_passport!=1){
    $_SESSION['upd_msg'] = 'Ошибка добавления паспорта!'; ?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
    <?php die();}
$add_work_history = mysqli_query($connect, "INSERT INTO work_history( worker_id, staff_list_id, work_start_date, number_of_staff_units) 
VALUES ($worker_id, $staff_list_id, '$work_start_date', $number_of_staff_units)");
if($add_passport!=1){
    $_SESSION['upd_msg'] = 'Ошибка добавления трудовой истории!'; ?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
    <?php die();}
if ( isset($_POST['mil_check']) == true ) {
    mysqli_query($connect, "INSERT INTO military_registration(worker_id, registration_type) VALUES ($worker_id, '$registration_type')");

}

if ( isset($_POST['dis_check']) == true ) {
        mysqli_query($connect, "INSERT INTO disability(disability_id, worker_id, disability_group) VALUES ($disability_id, $worker_id, $disability_group)");
}

if($mobile!="") {
        mysqli_query($connect, "INSERT INTO contact(contact_type, contact, worker_id) VALUES ('мобильный телефон', '$mobile' ,$worker_id)");
}

if($home!="") {
        mysqli_query($connect, "INSERT INTO contact(contact_type, contact, worker_id) VALUES ('домашний телефон', '$home' ,$worker_id)");
}

if($mail!="") {
        mysqli_query($connect, "INSERT INTO contact(contact_type, contact, worker_id) VALUES ('e-mail', '$mail' ,$worker_id)");
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

$_SESSION['create_msg'] = 'Работник добавлен!';
print_r('passport');
print_r($add_passport);
print_r('history');
print_r($add_work_history);
print_r('worker');
print_r($add_worker);

?>
<!--<meta http-equiv="refresh" content="0; url=../profile.php">-->


