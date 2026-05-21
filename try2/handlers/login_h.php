<?php
session_start();

require_once '../includes/auth.php';
require_once '../includes/db.php';
$_SESSION['form_data'] = $_POST;
if (!$_POST['login'] || !$_POST['password'] ) {
    $_SESSION['error_alert'] = 'Заполните все поля';
    header('Location: ../pages/login.php');
    exit;
}
$login = trim($_POST['login'] ?? '');
$password = $_POST['password'] ?? '';



if ($login === "" || $password === '') {
    $_SESSION['error_alert'] = 'Поля не могут быть пустыми';
    header('Location: ../pages/login.php');
    exit;
}



$stmt = $db->prepare('SELECT * FROM users WHERE login=?');

if (!$stmt) {
    $_SESSION['error_alert'] = 'Ошибка подготовки запроса';
    header('Location: ../pages/register.php');
    exit;
}
$stmt->bind_param('s', $login);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows != 1) {
    $_SESSION['error_alert'] = 'Неверный логин или пароль';
    $stmt->close();
    header('Location: ../pages/login.php');
    exit;
}

$user = $result-> fetch_assoc();


if (!password_verify($password, $user['password'])) {
    $_SESSION['error_alert'] = 'Неверный логин или пароль';
    header('Location: ../pages/login.php');
    $stmt->close();
    exit;
}
$_SESSION['id'] = $user['id'];
$_SESSION['full_name'] = $user['full_name'];
$_SESSION['phone'] = $user['phone'];
$_SESSION['email'] = $user['email'];
$_SESSION['is_admin'] = $user['is_admin'];


$stmt->close();
$_SESSION['success_alert'] = "Успешная авторизация";
header('Location: ../pages/profile.php');
exit;
