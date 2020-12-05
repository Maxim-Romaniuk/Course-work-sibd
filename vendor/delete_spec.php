<?php

session_start();
require_once 'connect.php';

$spec_code = $_POST['spec_code_del'];


$del_spec = mysqli_query($connect, "DELETE FROM specialty where specialty_code='$spec_code'");

if ($del_spec==1) :
    $_SESSION['add_spec_msg'] = 'Специальность удалена!';?>
    <meta http-equiv="refresh" content="0; url='../pages/admin/specialty_list.php' ?>">
<?php else :
    $_SESSION['add_spec_msg'] = 'Ошибка удаления!';?>
    <meta http-equiv="refresh" content="0; url=<?= $_SERVER["HTTP_REFERER"] ?>">
<?php endif;
unset($_POST['spec_code_del']);


?>

