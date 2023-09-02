<?php
define('HOST', '127.0.0.1');
define('USUARIO', 'Thaynison');
define('SENHA', 'noFoge');
define('DB', 'planejamento');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possivel conectar ao banco de dados');
?>