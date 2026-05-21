<?php
session_start();

require_once '../includes/auth.php';
require_once '../includes/db.php';
requireUser();


if (!$_POST['service_id'] || !$_POST['pay_method_id'] || !$_POST['date'] ) {
    $_SESSION['error_alert'] = 'Заполните все поля';
    header('Location: ../pages/new_app.php');
    exit;
}
$service_id = trim($_POST['service_id'] ?? '');
$pay_method_id = trim($_POST['pay_method_id'] ?? '');
$date = trim($_POST['date'] ?? '');

$today = date('Y-m-d');
var_dump($today);
if ($date < $today) {
    $_SESSION['error_alert'] = 'Дата должна быть не раньше сегодняшней';
    header('Location: ../pages/new_app.php');
    exit;
}


$stmt = $db->prepare('INSERT INTO applications (user_id, service_id, pay_method_id, date) VALUES (?,?,?,?)');
if (!$stmt) {
    $_SESSION['error_alert'] = 'Ошибка подготовки запроса';
    header('Location: ../pages/new_app.php');
    exit;
}
$stmt->bind_param('iiis', $_SESSION['id'], $service_id, $pay_method_id, $date);
$stmt->execute();

$stmt->close();
$_SESSION['success_alert'] = "Заявка успешно создана";
header('Location: ../pages/profile.php');
exit;
