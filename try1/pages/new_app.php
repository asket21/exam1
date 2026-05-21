<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
session_start();
requireUser();
$page_title = 'Запись на услугу';

$services = $db->query('SELECT * FROM services');
if (!$services) {
    die('Ошибка запроса: ' . $db->error);
}
$services = $services->fetch_all(MYSQLI_ASSOC);

$statuses = $db->query('SELECT * FROM statuses');
if (!$statuses) {
    die('Ошибка запроса: ' . $db->error);
}
$statuses = $statuses->fetch_all(MYSQLI_ASSOC);

$methods_pay = $db->query('SELECT * FROM pay_methods');
if (!$methods_pay) {
    die('Ошибка запроса: ' . $db->error);
}
$methods_pay = $methods_pay->fetch_all(MYSQLI_ASSOC);

include '../includes/header.php';


?>

<h1>Заявка на услугу</h1>

<form action="../handlers/new_app_h.php" method='POST'>
   <?php
       show_alert()
       ?>
    <div class="mb-3">
        <label for="" class="form-label">Выберите услугу</label>
        <select name="service_id" id="service" class="form-select">
            <?php
            foreach ($services as $service):        ?>
                <option value="<?= $service['id'] ?>"><?= $service['title'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="application_date" class="form-label">Выберите дату</label>
        <input type="date" class="form-control" name='application_date' id='application_date' required>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Выберите способ оплаты</label>
        <select name="method_pay_id" id="method_pay_id" class='form-select'>
            <?php
            foreach ($methods_pay as $method_pay):
            ?>
                <option value="<?= $method_pay['id'] ?>"><?= $method_pay['title'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn btn-primary" type='submit'>Отправить заявку</button>




</form>


<?php
include '../includes/footer.php';


?>