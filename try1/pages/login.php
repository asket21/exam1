<?php 
require_once '../includes/auth.php';
session_start();
if (checkIsUser()){
    header('Location: ./profile.php');
    exit;
}


$page_title = 'Авторизация';


include '../includes/header.php';?>
<h1>Авторизация</h1>
<?php
       show_alert()
       ?>
<form action="../handlers/login_h.php" method="POST">

<div class="mb-3">
    <label for="login" class="form-label">Логин</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="Введите логин">

</div>
<div class="mb-3">
    <label for="password" class="form-label">Пароль</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль">
    
</div>



<button class="btn btn-primary" type="submit">Войти</button>
</form>
<?php
include '../includes/footer.php';
?>