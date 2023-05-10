<?php
session_start();
ob_start();
require_once "config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$id = $_SESSION["id"];

?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Boas vindas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Seja bem vindo(a)!</h1>
    <p>Deseja inserir ou alterar o seu currículo agora?</p>
    <p>
        <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-warning">Ir para meu currículo</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sair da conta</a>
    </p>
</body>
</html>