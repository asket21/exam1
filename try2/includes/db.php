<?php

$db = new mysqli('127.0.0.1', 'root','','mfc2');


if ($db-> connect_error) {
    die( ' Ошибка подключения к БД : ' . $db -> connect_error );
}



$services = $db -> query('SELECT * from services')-> fetch_all(MYSQLI_ASSOC);


$pay_methods = $db -> query('SELECT * from pay_methods')-> fetch_all(MYSQLI_ASSOC);

$statuses = $db -> query('SELECT * from statuses')-> fetch_all(MYSQLI_ASSOC);

?>