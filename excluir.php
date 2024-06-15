<?php

$con = new PDO ("mysql:host=localhost;dbname=banco_aula","root", "");

if (isset($_GET["id"])){
    $id = $_GET["id"];
    $con->exec("DELETE FROM usuarios WHERE id = $id");
    echo "Exclusão realizada com sucesso!";
    require 'pagina.php';

}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXERCICIO</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
<h1>Deletar</h1>
<main>
<form action="excluir.php" method="post">
    <label for="id">Digite o ID:</label>
    <input type="int" id="id" name="id-input"> <br>
    <a href="pagina.php">voltar</a>


                    <input type="submit" value="Deletar" id="enviar"> <br>
</form>
    </main>



