<?php
require_once '../includes/db.php';
session_start();
$login = trim($_POST['login'] ?? '');
$full_name = trim($_POST['full_name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'];

if (strlen($login) < 6) {
    $_SESSION['error_message'] = 'Логин минимум 6 символов';
    header('Location: ../pages/register.php');
    exit;
}

if (strlen($password) < 6) {
    $_SESSION['error_message'] = 'Пароль минимум 8 символов';
    header('Location: ../pages/register.php');
    exit;
}
$passwordHashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $db->prepare('SELECT * FROM users WHERE login = ? OR email = ?');
$stmt->bind_param('ss', $login, $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $stmt->close();
    $_SESSION['regiter_error'] = 'Пользователь с таким логином существует';
    header('Location:../pages/register.php');
};

$stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $stmt->close();
    $_SESSION['regiter_error'] = 'Пользователь с таким email существует';
    header('Location:../pages/register.php');
};


$stmt = $db->prepare('INSERT INTO users (login, passwordHashed, full_name, phone, email) VALUES (?,?,?,?,?)');
$stmt->bind_param('sssss', $login, $passwordHashed, $full_name, $phone, $email);
$stmt->execute();
$stmt->close();
