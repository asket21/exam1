<?php
session_start();
include_once '../includes/auth.php';
include_once '../includes/db.php';
$page_title = 'Мои заявки';
requireUser();



include '../includes/header.php';?>

<h1>Добро пожаловать, <?= $_SESSION['full_name'] ?></h1>
<h2>Мои Заявки</h2>
<?php show_alert()?>
<?php   $stmt = $db->prepare('SELECT a.id, a.date ,
 serv.title as service_title,
 st.title as status_title,
 pm.title as pay_method_title
 FROM applications a
 JOIN services serv ON serv.id = a.service_id
 JOIN statuses st ON st.id = a.status_id
 JOIN pay_methods pm ON pm.id = a.pay_method_id

 WHERE user_id = ? 
 ORDER by created_at DESC
 ');

if (!$stmt) {
    $_SESSION['error_alert'] = 'Ошибка подготовки запроса';
    header('Location: ../index.php');
    exit;
}
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0):?>
    <p class="alert alert-danger">У вас пока нет заявок</p>
    <?php else:?>
<table class="table table-bordered">
<thead>
    <tr>
        <th>Номер заявки</th>
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
    <td><?= htmlspecialchars($application['date']) ?></td>
    <td><?= htmlspecialchars($application['service_title']) ?></td>
    <td><?= htmlspecialchars($application['pay_method_title']) ?></td>
    <td><?= htmlspecialchars($application['status_title']) ?></td>
</tr>
<?php endforeach;?>

</tbody>

</table>

<?php endif;?>





<?php
include '../includes/footer.php';

?>