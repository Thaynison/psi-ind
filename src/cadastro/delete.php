<?php

session_start();

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    include('../conexao/conexao.php');

    $sql = "DELETE FROM cracha WHERE id = $id";
    $connec->query($sql);
}

header("location: ../paginas/cadastro.php");
exit;
?>