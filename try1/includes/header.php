<?php

include_once '../includes/auth.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Городской центр услуг' ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        
<?php if(checkIsUser()):?>
         <nav class="navbar navbar-expand-lg">
            
        <a href="#" class="navbar-brand">Городской центр услуг</a>
    <ul class="navbar-nav">
        <li class="nav-item"><a href="../index.php" class="nav-link">Главная</a></li>
        <?php if(checkIsAdmin()):?>
        <li class="nav-item"><a href="admin.php" class="nav-link">Все заявки</a></li>
        <?php endif;?>
        <li class="nav-item"><a href="profile.php" class="nav-link">Мои заявки</a></li>
        <li class="nav-item"><a href="new_app.php" class="nav-link">Новая заявка</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link">Выйти</a></li>
    </ul>
    

    </nav>
    <?php else:?>


<nav class="navbar  navbar-expand-lg">
    
        <a href="#" class="navbar-brand">Городской центр услуг</a>
    <ul class="navbar-nav">
        <li class="nav-item"><a href="../index.php" class="nav-link">Главная</a></li>
        <li class="nav-item"><a href="login.php" class="nav-link">Войти</a></li>
        <li class="nav-item"><a href="register.php" class="nav-link">Регистрация</a></li>
    </ul>

    </nav>

<?php endif;?>
