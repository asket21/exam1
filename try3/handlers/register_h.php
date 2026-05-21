<?php
session_start();

require_once '../includes/auth.php';
require_once '../includes/db.php';

if (!$_POST['login'] || !$_POST['password'] || !$_POST['full_name'] || !$_POST['phone'] || !$_POST['email']) {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['error_alert'] = 'Заполните все поля';
    header('Location: ../pages/register.php');
    exit;
}
$login = trim($_POST['login'] ?? '');
$password = $_POST['password'] ?? '';
$full_name = trim($_POST['full_name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');


if (strlen($login) < 6) {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['error_alert'] = 'Логин минимум 6 символов';
    header('Location: ../pages/register.php');
    exit;
}

if (!preg_match('/^[a-zA-Z0-9]{6,}$/', $login)) {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['error_alert'] = 'Логин минимум 6 символов, латиница и цифры';
    header('Location: ../pages/register.php');
    exit;
}

if (strlen($password) < 8) {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['error_alert'] = 'Пароль минимум 8 символов';
    header('Location: ../pages/register.php');
    exit;
}

if (!preg_match('/[а-яА-Я Ёё]$/', $full_name)) {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['error_alert'] = 'Кирилица и пробелы ';
    header('Location: ../pages/register.php');
    exit;
}

if (!preg_match('/8\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}$/', $phone)) {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['error_alert'] = 'Телефон в формате 8(ХХХ)ХХХ-ХХ-ХХ';
    header('Location: ../pages/register.php');
    exit;
}



$hashPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $db->prepare('SELECT * FROM users WHERE login=?');

if (!$stmt) {
    $_SESSION['error_alert'] = 'Ошибка подготовки запроса';
    $_SESSION['form_data'] = $_POST;
    header('Location: ../pages/register.php');
    exit;
}
$stmt->bind_param('s', $login);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['error_alert'] = 'Пользователь с таким логином существует';
    $stmt->close();
    header('Location: ../pages/register.php');
    exit;
}
$stmt = $db->prepare('SELECT * FROM users WHERE email=?');

if (!$stmt) {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['error_alert'] = 'Ошибка подготовки запроса';
    header('Location: ../pages/register.php');
    exit;
}
$stmt->bind_param('s', $email);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['error_alert'] = 'Пользователь с таким email существует';
    $stmt->close();
    header('Location: ../pages/register.php');
    exit;
}
$stmt = $db->prepare('INSERT INTO users (login, password, full_name, phone, email) VALUES (?,?,?,?,?)');
if (!$stmt) {
    $_SESSION['form_data'] = $_POST;
    $_SESSION['error_alert'] = 'Ошибка подготовки запроса';
    header('Location: ../pages/register.php');
    exit;
}
$stmt->bind_param('sssss', $login, $hashPassword, $full_name, $phone, $email);
$stmt->execute();

$stmt->close();
$_SESSION['success_alert'] = "Пользователь $login успешно зарегистрирован";
header('Location: ../pages/login.php');
exit;
