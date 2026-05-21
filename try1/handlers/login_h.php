<?php
require_once '../includes/db.php';
session_start();
$login = trim($_POST['login'] ?? '');
$password = $_POST['password'] ?? '';

if (trim($login) === '' || trim($password) === '') {
    $_SESSION['error_message'] = 'Логин и пароль не могут быть пустыми';
    header('Location: ../pages/login.php');
    exit;
}



$stmt = $db->prepare('SELECT * FROM users WHERE login = ?');

$stmt->bind_param('s', $login);
$stmt->execute();
$results = $stmt->get_result();

if ($results->num_rows === 0) {
    $stmt->close();
    $_SESSION['logine_error'] = 'Неверный логин или пароль';
    header('Location: ../pages/login.php');
    exit;
}

$user = $results->fetch_assoc();

if (!password_verify($password, $user['password'])) {
    $stmt->close();
    $_SESSION['error_message'] = 'Неверный логин или пароль';
    header('Location: ../pages/login.php');
    exit;
};

$_SESSION['id'] = $user['id'];
$_SESSION['login'] = $user['login'];
$_SESSION['full_name'] = $user['full_name'];
$_SESSION['is_admin'] = $user['is_admin'];

header('Location:../pages/profile.php');
exit;
