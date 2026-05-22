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
$page_title = 'Авторизация';
include '../includes/header.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="../handlers/login_h.php" method="post" id="logForm">
                        <h2 class="card-title text-center mb-4">Авторизация</h2>
                        <?php show_alert(); ?>
                        <div class="mb-3">
                            <label for="login" class="form-label">Логин</label>
                            <input type="text" name="login" id="login" class="form-control" 
                                   placeholder="Введите логин" required
                                   value="<?= htmlspecialchars($form_data['login'] ?? '') ?>">
                                   <div class="error-message text-danger small mt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" name="password" id="password" 
                                   class="form-control" placeholder="Введите пароль" required>
                        </div>
                        <div class="error-message text-danger small mt-1"></div>
                        <div class="row align-items-center">
                            <button class="col-12 col-md-6 w-100 btn btn-primary" type="submit">Авторизоваться</button>
                            <p class="col-12 col-md-6 w-100 text-center mt-2 mt-md-0">
                                Еще не зарегистрированы? <a href="./register.php">Зарегистрироваться</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php'; ?>