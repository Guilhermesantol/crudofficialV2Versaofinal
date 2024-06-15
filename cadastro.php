<?php
if (isset($_POST['email-input']) && isset($_POST['senha-input']) && isset($_POST['nome-input'])) {
    if (!empty(($_POST['email-input'])) && !empty (($_POST['senha-input']) && !empty (($_POST['nome-input'])))) {

        print_r($_POST);
        $nome = filter_input(INPUT_POST, 'nome-input', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email-input', FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = filter_input(INPUT_POST, 'senha-input', FILTER_SANITIZE_SPECIAL_CHARS);

        $PDO = new PDO('mysql:host=localhost;dbname=banco_aula', 'root', '');

        $dados = [
            "nome" => $nome,
            "email" => $email,
            "senha" => $senha
        ];

        $sql = "insert into usuarios (id,nome,email,senha) values(NULL, :nome, :email, sha1 (:senha))";
        $resultado = $PDO->prepare($sql);
        $resultado->execute($dados);
        $msgsucesso = "Cadastro realizado com sucesso!";
    }
    else{
        $msgsucesso = "Preencha todos os campos!";
    }


    $resultado = $PDO->query("SELECT * FROM usuarios");

}


?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/pico.amber.min.css">
</head>
<body>
<h1>Cadastro Do Usuário</h1>
<form action="cadastro.php" method=post>
    <label for="nome">nome</label>
    <input type="text" id="nome" name="nome-input">

    <label for="email">seu email</label>
    <input type="text" id="email" name="email-input">

    <label for="senha">senha</label>
    <input type="password" id="password" name="password-input">
    <input type="submit" value="enviar
    </form>
    </main>
<section>
    <h1> Gerenciamento do banco </h1> <br>
    <a href="Create.php"><button><h1>Create</h1></button></a>
    <a href="Read.php"><button><h1>Read</h1></button></a>
    <a href="Update.php"><button><h1>Update</h1></button></a>
    <a href="Delete.php"><button><h1>Delete</h1></button></a>
    </section>

    ">


</form>



