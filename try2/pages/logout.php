<?php
session_start();
$_SESSION[] = [];
session_destroy();
header('Location:../index.php');
$_SESSION['succes_alert'] = 'Выход совершен';
exit;
?>
