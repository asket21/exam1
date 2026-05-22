<?php 
session_start();
require_once 'includes/auth.php';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Городской центр услуг</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php if(!checkIsUser()) : ?>  
           
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">Городской центр услуг</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/login.php" class="nav-link">Вход</a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/register.php" class="nav-link">Регистация</a>
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
                        <a href="#" class="nav-link">Главная</a>
                    </li>
                    <?php if(checkIsAdmin()):?>
                    <li class="nav-item">
                        <a href="pages/admin.php" class="nav-link">Все заявки</a>
                    </li>
                    <?php endif;?>
                    <li class="nav-item">
                        <a href="pages/profile.php" class="nav-link">Мои заявки</a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/new_app.php" class="nav-link">Сделать заявку</a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/logout.php" class="nav-link">Выход</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php endif?>
<h1>Добро пожаловать</h1>
<?php show_alert()?>

<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel"
data-bs-interval="3000"
>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Предыдущий слайд</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Следующий</span>
  </button>
</div>

    </div>
    <script src='js/bootstrap.bundle.min.js'></script>
</body>
</html>