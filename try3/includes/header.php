<?php 
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Услуги'?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
    <body>
    <div class="container">

     <?php if(!checkIsUser()) : ?>  
           
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">Городской центр услуг</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a href="../pages/login.php" class="nav-link">Вход</a>
                    </li>
                    <li class="nav-item">
                        <a href="../pages/register.php" class="nav-link">Регистация</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php else: ?>
             <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">Городской центр услуг</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link">Главная</a>
                    </li>
                    <?php if(checkIsAdmin()):?>
                    <li class="nav-item">
                        <a href="../pages/admin.php" class="nav-link">Все заявки</a>
                    </li>
                    <?php endif;?>
                    <li class="nav-item">
                        <a href="../pages/profile.php" class="nav-link">Мои заявки</a>
                    </li>
                    <li class="nav-item">
                        <a href="../pages/new_app.php" class="nav-link">Сделать заявку</a>
                    </li>
                    <li class="nav-item">
                        <a href="../pages/logout.php" class="nav-link">Выход</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php endif?>