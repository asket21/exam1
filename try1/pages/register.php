<?php 
session_start();
require_once '../includes/auth.php';

$page_title = 'Регистрация';
if (checkIsUser()){
    header('Location: ./profile.php');
    exit;
}
var_dump($_SESSION['id']);

include '../includes/header.php';?>
<h1>Регистрация</h1>
<form action="../handlers/register_h.php" method="POST">
<?php
       show_alert()
       ?>
<div class="mb-3">
    <label for="login" class="form-label">Логин</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="Придумайте логин">
    <span>Минимум 6 символов и цифр, латиница</span>
</div>
<div class="mb-3">
    <label for="password" class="form-label">Пароль</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Придумайте пароль">
    <span>Минимум 8 символов</span>
</div>
<div class="mb-3">
    <label for="full_name" class="form-label">ФИО</label>
    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Введите ФИО">
    <span>Кирилица и пробелы</span>
</div>
<div class="mb-3">
    <label for="phone" class="form-label">Номер телефона</label>
    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Введите номер телефона">
    <span>Телефон в формате 8(ХХХ)-ХХХ-ХХ-ХХ</span>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Введите email">
    
</div>



<button class="btn btn-primary" type="submit">Зарегистрироваться</button>
</form>
<?php
include '../includes/footer.php';
?>