<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';
$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['form_data']);

if(checkIsUser()){
    header('Location: ./profile.php');
    exit;
    
}
include '../includes/header.php';
?>
<form action="../handlers/register_h.php" method='post'>

        <?php 
        show_alert();
        ?>
    <h2>Регистрация</h2>
    <div class="mb-3">
        <label for="login" class="form-label">Логин</label>
        <input type="text" name='login' id='login' class="form-control" placeholder="Придумайте логин" required value="<?= htmlspecialchars($form_data['login']) ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" name= 'password' id='password' class="form-control" placeholder="Придумайте пароль"  required>
    </div>
    <div class="mb-3">
        <label for="full_name" class="form-label">ФИО</label>
        <input type="text" name='full_name' id='full_name' class="form-control" placeholder="Иванов Иван Иванович" value="<?= htmlspecialchars($form_data['full_name']) ?? '' ?>" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Номер телефона</label>
        <input type="tel" name='phone' id='phone' class="form-control" placeholder="Введите номер телефона" required value="<?= htmlspecialchars($form_data['phone']) ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name='email' id='email' class="form-control" placeholder="Введите email"  value="<?= htmlspecialchars($form_data['email']) ?? '' ?>" required>
    </div>
    <div class='row'><button class="col-3  btn btn-primary" type='submit'>Зарегистрироваться</button> <p  class='text-center col-3'>Уже зарегистрирован?<a href="./login.php">Войти</a></p></div>
    
</form>
<?php
include '../includes/footer.php'; ?>