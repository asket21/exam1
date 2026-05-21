<?php

function show_alert(){
    
       if(isset($_SESSION['success_message'])){
      echo  '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
        unset($_SESSION['success_message']); 
       }
    if(isset($_SESSION['error_message'])){
      echo  '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
        unset($_SESSION['error_message']); 
       }

}

function checkIsUser()
{
    return isset($_SESSION['id']);
}

function checkIsAdmin()
{
    if (checkIsUser()) {
        if ($_SESSION['is_admin'] === 1) {
            return true;
        }
    } else {
        return false;
    };
    return false;
}

function requireAdmin()
{
    if (!checkIsAdmin()) {
        header('Location:../pages/profile.php');
        exit;
    };
};


function requireUser()
{
    if (!checkIsUser()) {
        header('Location: ../index.php');
        exit;
    };
}
