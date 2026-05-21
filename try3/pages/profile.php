<?php
session_start();
include_once '../includes/auth.php';
include_once '../includes/db.php';
$page_title = 'Мои заявки';
requireUser();



include '../includes/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="card-title">Добро пожаловать, <?= $_SESSION['full_name'] ?></h1>
                    <h2>Мои заявки</h2>
                    <?php show_alert(); ?>
                    <?php $stmt = $db->prepare('SELECT a.id, a.date ,
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

                    $result = $stmt->get_result(); ?>

                    <?php if ($result->num_rows === 0): ?>
                        <p class="alert alert-danger">У вас пока нет заявок</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
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
                                    $applications = $result->fetch_all(MYSQLI_ASSOC); ?>
                                    <?php foreach ($applications as $application): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($application['id']) ?></td>
                                            <td><?= htmlspecialchars($application['date']) ?></td>
                                            <td><?= htmlspecialchars($application['service_title']) ?></td>
                                            <td><?= htmlspecialchars($application['pay_method_title']) ?></td>
                                            <td><?= htmlspecialchars($application['status_title']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';

?>