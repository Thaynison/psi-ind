<?php
session_start();
include('../conexao/conexao.php');

if (isset($_POST['cpf']) && isset($_POST['senha'])) {
    $cpf = mysqli_real_escape_string($connec, $_POST['cpf']);
    $senha = mysqli_real_escape_string($connec, $_POST['senha']);

    $query = "SELECT * FROM cracha WHERE cpf = '$cpf' AND senha = '$senha'";
    $result = mysqli_query($connec, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['cpf'] = $cpf;
        $_SESSION['funcao'] = $row['funcao'];

        switch ($_SESSION['funcao']) {
            case 'Tec. Segurança do Trabalho':
            case 'Supervisor':
            case 'Planejador':
            case 'Administracao':
            case 'Dono':
                header("Location: ../paginas/cadastro.php");
                break;
            default:
                header("Location: ../paginas/funcionario.php");
                break;
        }
    } else {
        $_SESSION['mensagem'] = "E-mail ou senha inválidos.";
        header("Location: login.php");
    }
} else {
    header("Location: login.php");
}