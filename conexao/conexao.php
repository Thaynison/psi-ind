<?php
session_start();
$DB_HOST=$_ENV["DB_HOST"];
$DB_USER=$_ENV["DB_USER"];
$DB_PASSWORD=$_ENV["DB_PASSWORD"];
$DB_NAME=$_ENV["DB_NAME"];
$DB_PORT=$_ENV["DB_PORT"];
$conexao = mysqli_connect("DB_HOST", "DB_USER", "DB_PASSWORD", "DB_NAME", "DB_PORT") or die ('Não foi possivel conectar ao banco de dados');
?>