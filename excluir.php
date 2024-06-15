<?php

if (isset($_POST['id-input'])) {
    $PDO = new PDO('mysql:host=localhost;dbname=banco_aula', 'root', '');

    $id = $_POST['id-input'];

    if (!empty($id)) {
        $sqldelete = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $PDO->prepare($sqldelete);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Registro deletado com sucesso!";
        } else {
            echo "erro ao deletar registro";
        }
    } else {
        echo "Id não foi enviado";
    }
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


                    <input type="submit" value="Deletar" id="enviar"> <br>
</form>
    </main>



