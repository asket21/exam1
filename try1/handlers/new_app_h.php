<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';

requireUser();
if (!isset($_POST['service_id'], $_POST['application_date'], $_POST['method_pay_id'])) {
    $_SESSION['error_message'] = 'Зaполните все поля';
    header('Location:../pages/new_app.php');
    exit;
}
$service_id = $_POST['service_id'];
$application_date = $_POST['application_date'];
$pay_method_id = $_POST['method_pay_id'];

$today = date('Y-m-d');

if ($application_date < $today) {
    $_SESSION['error_message'] = "Дата должна быть не раньше сегодня";
    header('Location:../pages/new_app.php');
    exit;
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $application_date)) {
    $_SESSION['error_message'] = "Неверный формат даты ";
    header('Location: ../pages/new_app.php');
    exit;
}

$stmt = $db->prepare('INSERT INTO applications (user_id, service_id, pay_method_id, application_date) VALUES(?,?,?,?)');
if (!$stmt) {
    $_SESSION['error_message'] = 'Ошибка подготовки запроса';
    header('Location:../pages/new_app.php');

    exit;
}
$stmt->bind_param("iiis", $_SESSION['id'], $service_id, $pay_method_id, $application_date);

if (!$stmt->execute()) {

    $_SESSION['error_message'] = "Ошибка запроса";
    header('Location:../pages/new_app.php');
    $stmt->close();
    exit;
}
$stmt->close();
$_SESSION['success_message'] = 'Новая заявка успешно создана';
header('Location:../pages/new_app.php');
exit;
