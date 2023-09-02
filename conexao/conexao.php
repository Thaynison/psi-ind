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

if (isset($_SERVER['HTTP_HOST'])) {
    $host = $_SERVER['HTTP_HOST'];

    if (strpos($_SERVER['REQUEST_URI'], '.php') === false) {
        // A URL não contém .php, redirecione para a versão com .php
        $url = "https://$host$_SERVER[REQUEST_URI].php";
        header("Location: $url", true, 301);
        exit();
    } elseif (preg_match('/^(.+)\.php/', $_SERVER['REQUEST_URI'], $matches)) {
        // A URL contém .php, redirecione para a versão sem .php
        $url = "https://$host$matches[1]";
        header("Location: $url", true, 301);
        exit();
    }
}
?>
