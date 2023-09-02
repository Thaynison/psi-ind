<?php
session_start();
$DB_HOST = "containers-us-west-113.railway.app";
$DB_NAME = "railway";
$DB_PASSWORD = "mmbcUTHymnuEUj2cuPa5";
$DB_PORT = 7609;
$DB_USER = "root";

$conexao = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT);

if (!$conexao) {
    die('Não foi possível conectar ao banco de dados: ' . mysqli_connect_error());
}

?>
