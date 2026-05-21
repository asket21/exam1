<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';

requireUser();

$page_title = 'Создание заявки';
include '../includes/header.php';
?>

<form action="../handlers/new_app_h.php" method='post'>
    <h2>Запись на услугу в городской центр услуг</h2>
        <?php 
        show_alert();
        ?>

    <div class="mb-3">
        <label for="login" class="form-label">Выберите уcлугу</label>
        <select name="service_id" id="service" class="form-select">
<?php foreach($services as $service):?>
    <option value="<?= $service['id']?>"><?= $service['title']?></option>
<?php endforeach;?>
        </select>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Выберите дату</label>
        <input type="date" name='date' id='date' class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="pay_method" class="form-label">Способ оплаты</label>
       <select name="pay_method_id" id="pay_method" class="form-select">
<?php foreach($pay_methods as $pay_method):?>
    <option value="<?= $pay_method['id']?>"><?= $pay_method['title']?></option>
<?php endforeach;?>
        </select>
    </div> 
   <button class="  btn btn-primary" type='submit'>Записаться на услугу</button>

</form>

<?php
include '../includes/footer.php'; ?>