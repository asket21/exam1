<?php
function checkIsUser()
{
    return isset($_SESSION['id']);
}


function checkIsAdmin()
{
    if (checkIsUser()) {
        if ($_SESSION["is_admin"] === 1) {
            return true;
        }
    } else {
        return false;
    };

    return false;
}


function requireUser()
{
    if (!checkIsUser()) {
        header('Location: ../pages/login.php');
        exit;
    }
}

  function requireAdmin()
    {
        if (!checkIsAdmin()) {
            header('Location: ../pages/profile.php');
            exit;
        }
    }

 
function show_alert() {
    if(isset($_SESSION['success_alert'])){
        echo '<div class="alert alert-success">' .htmlspecialchars($_SESSION['success_alert']) . '</div>';
        unset($_SESSION['success_alert']);
    }

    if(isset($_SESSION['error_alert'])){
        echo '<div class="alert alert-danger">' .htmlspecialchars($_SESSION['error_alert']) . '</div>';
        unset($_SESSION['error_alert']);
    }
}



?>
