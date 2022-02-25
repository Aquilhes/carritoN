<?php
$DB_SERVER = "localhost";
$DB_USER = "administrador";
$DB_PASSWD = "Daendish3490.";
$DB_NAME = "db_shopnoche";

$conn = new mysqli($DB_SERVER, $DB_USER, $DB_PASSWD, $DB_NAME);

if ($conn->connect_error) {
    die("Error al conectar: " . $conn->connect_error);
}
