<?php

require_once '../includes/db.php';
require_once '../includes/auth.php';
$page_title = 'Страница профиля';
session_start();
requireUser();

include '../includes/header.php';
?>

<h1>Добро пожаловать на портал городских услуг, <?= $_SESSION['full_name'] ?></h1>

<h2>Мои заявки</h2>
<?php
       show_alert()
       ?>
<?php 
$stmt = $db -> prepare('SELECT a.id, a.application_date,
s.title as service_title, m.title as pay_method_title,
st.title as app_status
FROM applications a
JOIN services s ON a.service_id = s.id
JOIN pay_methods m ON a.pay_method_id = m.id
JOIN statuses st ON a.status_id = st.id
WHERE a.user_id = ?
ORDER by a.created_at DESC'
);
$stmt -> bind_param('i',$_SESSION["id"]);
$stmt -> execute();
$results = $stmt-> get_result();
if ($results -> num_rows === 0):?>
<p class="alert danger-alert">У вас пока нет заявок</p>
<?php else:?>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>№ Заявки</th>
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
            <td><?=htmlspecialchars($application['application_date']) ?></td>
            <td><?=htmlspecialchars($application['service_title']) ?></td>
            <td><?=htmlspecialchars($application['pay_method_title']) ?></td>
            <td><?=htmlspecialchars($application['app_status']) ?></td>
        </tr>
   <?php endwhile?>




    </tbody>
</table>

<?php
endif;
?>









<?php
include '../includes/footer.php';
?>