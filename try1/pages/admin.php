<?php

require_once '../includes/db.php';
require_once '../includes/auth.php';
$page_title = 'Страница администрирования';
session_start();
requireAdmin();

if (isset($_POST['update_status'])){
    $app_id = $_POST['update_status'];
    $new_status_id = $_POST['status'][$app_id];
    $stmt = $db -> prepare('UPDATE applications SET status_id = ?
    WHERE id = ?  ');
    $stmt -> bind_param('ss', $new_status_id, $app_id );
    $stmt -> execute();
    $_SESSION['success_message'] = "Статус заявки $app_id обновлен";
    header('Location: admin.php');
    exit;

}

$statuses = $db -> query('SELECT * FROM statuses');
if(!$statuses){
    die ('Ошибка запроса');
}
$statuses = $statuses -> fetch_all(MYSQLI_ASSOC);

include '../includes/header.php';
?>

<h1>Добро пожаловать на портал городских услуг, <?= $_SESSION['full_name'] ?></h1>

<h2>Все заяки</h2>
<?php 
$stmt = $db -> prepare('SELECT a.id, a.application_date, a.status_id,
s.title as service_title, m.title as pay_method_title,
st.title as app_status,
u.full_name as full_name
FROM applications a
JOIN services s ON a.service_id = s.id
JOIN pay_methods m ON a.pay_method_id = m.id
JOIN statuses st ON a.status_id = st.id
JOIN users u ON a.user_id =u.id
ORDER by a.created_at DESC'
);
$stmt -> execute();
$results = $stmt-> get_result();
if ($results -> num_rows === 0):?>
<p class="alert danger-alert"> Пока нет заявок</p>
<?php else:?>
    <form method='POST'>
       <?php
       show_alert()
       ?>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>№ Заявки</th>
            <th>Пользователь</th>
            <th>Дата приема</th>
            <th>Название услуги</th>
            <th>Способ оплаты</th>
            <th>Статус заявки</th>            
        </tr>
    </thead>
    <tbody>
    <?php 
     while ($application = $results->fetch_assoc()):
    ?>
        <tr>
            <td><?=htmlspecialchars($application['id']) ?></td>
            <td><?=htmlspecialchars($application['full_name']) ?></td>
            <td><?=htmlspecialchars($application['application_date']) ?></td>
            <td><?=htmlspecialchars($application['service_title']) ?></td>
            <td><?=htmlspecialchars($application['pay_method_title']) ?></td>
            <td><select name="status[<?= $application['id'] ?>]" id="status_id" >
                <?php
                foreach($statuses as $status):?>
                <option value="<?= $status['id'] ?>"<?= $status['id'] == $application['status_id'] ? 'selected' : '' ?>><?= $status['title'] ?></option>
                <?php endforeach;?>
            </select>
               <button type="submit" name="update_status" value="<?= $application['id'] ?>" class="btn btn-sm btn-primary">Обновить</button></td>
        </tr>
   <?php endwhile?>

    </tbody>
</table>
</form>
<?php
endif;
?>









<?php
include '../includes/footer.php';
?>