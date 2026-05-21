<?php
session_start();
require_once '../includes/auth.php';
require_once '../includes/db.php';
$page_title = 'Страница администрирования';
requireAdmin();

if (isset($_POST['status_update'])){
    $app_id = $_POST['status_update'];
    $new_status_id =  $_POST['status'][$app_id];

    $stmt = $db->prepare('UPDATE  applications SET status_id = ?
    WHERE id = ? ');

if (!$stmt) {
    $_SESSION['error_alert'] = 'Ошибка подготовки запроса';
    header('Location: ../index.php');
    exit;
}
$stmt->bind_param('ii', $new_status_id, $app_id);
$stmt->execute();

$_SESSION['success_alert'] = "Статус заявки $app_id изменен";
$stmt->close();
header('Location: admin.php');
exit;
}

include '../includes/header.php';?>

<h1>Добро пожаловать, <?= $_SESSION['full_name'] ?></h1>
<h2>Все Заявки</h2>
<?php show_alert()?>
<?php   $stmt = $db->prepare('SELECT a.id, a.user_id, a.date , a.status_id,
 serv.title as service_title,
 st.title as status_title,
 pm.title as pay_method_title
 FROM applications a
 JOIN services serv ON serv.id = a.service_id
 JOIN statuses st ON st.id = a.status_id
 JOIN pay_methods pm ON pm.id = a.pay_method_id
 ORDER by created_at DESC
 ');

if (!$stmt) {
    $_SESSION['error_alert'] = 'Ошибка подготовки запроса';
    header('Location: ../index.php');
    exit;
}

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0):?>
    <p class="alert alert-danger">Пока нет заявок</p>
    <?php else:?>
        <form  method="POST">
<table class="table table-bordered">
<thead>
    <tr>
        <th>Номер заявки</th>
        <th>ID Пользователя</th>
        <th>Дата заявки</th>
        <th>Услуга</th>
        <th>Способ оплаты</th>
        <th>Статус заявки</th>
    </tr>
</thead>
<tbody>
<?php
$applications = $result -> fetch_all(MYSQLI_ASSOC);?>
    <?php foreach ($applications as $application):?>
    

<tr>
    <td><?= htmlspecialchars($application['id']) ?></td>
    <td><?= htmlspecialchars($application['user_id']) ?></td>
    <td><?= htmlspecialchars($application['date']) ?></td>
    <td><?= htmlspecialchars($application['service_title']) ?></td>
    <td><?= htmlspecialchars($application['pay_method_title']) ?></td>
    <td>
        <select class='form-select' name="status[<?= $application['id'] ?>]" id="new_status_id">
          <?php foreach($statuses as $status): ?>
        <option value="<?=htmlspecialchars( $status['id']) ?>" <?= $application['status_id'] == $status['id'] ? 'selected' : '' ?>><?= htmlspecialchars($status['title']) ?> </option>
        <?php endforeach;?>
        </select>
        <button class="btn btn-primary" type='submit' name='status_update' value="<?= htmlspecialchars($application['id']) ?>">Обновить</button>
    </td>
</tr>

<?php endforeach;?>



</tbody>

</table>
</form>
<?php endif;?>





<?php
include '../includes/footer.php';

?>