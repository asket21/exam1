<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';
$form_data = $_SESSION['form_data'] ?? [];
if(checkIsUser()){
    header('Location: ./profile.php');
    exit;
}
$page_title = 'Авторизация';
include '../includes/header.php';
?>

<form action="../handlers/login_h.php" method='post'>
    <h2>Авторизация</h2>
        <?php 
        show_alert();
        ?>

    <div class="mb-3">
        <label for="login" class="form-label">Логин</label>
        <input type="text" name= 'login' id='login' class="form-control" placeholder="Придумайте логин" required value="<?= htmlspecialchars($form_data['login'])  ?? '' ?> ">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" name= 'password' id='password' class="form-control" placeholder="Придумайте gfhjkm" required>
    </div>
    
    <div class='row'><button class="col-3  btn btn-primary" type='submit'>Авторизоваться</button> <p  class='text-center col-3'>Еще не зарегистрированы?<a href="./register.php">Зарегистрироваться</a></p></div>

</form>

<?php
include '../includes/footer.php'; ?>