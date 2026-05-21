<?php   

$db = new mysqli('127.0.0.1','root','','mfc');

if ($db->connect_error){
    die('Ошибка подключения к БД: . $db->connect_error');
    
}
$db -> set_charset('utf8mb4');

?>
