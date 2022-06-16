<?php
session_start();
// echo json_encode($_SESSION['jsonResult']);
if(!empty($_GET['user']) && !empty($_GET['pass'])){
    $user = ($_GET['user']);
    $pass = ($_GET['pass']);
    header("Location: modules/verifylogin.php?user={$user}&pass={$pass}");
    exit;
}
echo json_encode($_SESSION['jsonResult']);
?>