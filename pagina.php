<?php
$msgvalidacao = ''; // Defina a variável antes de usá-la

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

    try {
        $con = new PDO("mysql:host=localhost;dbname=banco_aula", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $dados = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha
        ];

        $sql = "INSERT INTO usuarios (id, nome, email, senha) VALUES (NULL, :nome, :email, sha1(:senha))";
        $resultado = $con->prepare($sql);
        $resultado->execute($dados);
        $msgvalidacao = "Cadastro realizado com sucesso!";
    } catch (PDOException $e) {
        $msgvalidacao = "Erro ao cadastrar: " . $e->getMessage();
    }
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/pico.amber.min.css">
    <title>Cadastro</title>
</head>
<body>
<h1>Cadastro de usuário</h1>
<p><?php echo $msgvalidacao; ?></p>
<form action="pagina.php" method="post">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" placeholder="Insira o nome" required>
    <br>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Insira o email" required>
    <br>
    <label for="senha">Senha</label>
    <input type="password" id="senha" name="senha" placeholder="Insira a senha"
           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
    <br>
    <input type="submit" value="Enviar">
</form>
<div>
    <h2>Lista de usuários</h2>
    <?php
    try {
        $con = new PDO("mysql:host=localhost;dbname=banco_aula", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $resultado = $con->query("SELECT * FROM usuarios");
        while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
            echo htmlspecialchars($linha['nome']) . " - " . htmlspecialchars($linha['email']) . " - " . "<a href=\"updatewebs.php?id=" . htmlspecialchars($linha['id']) . "\">Atualizar</a>." . " - " . "<a href=\"excluir.php?id=" . htmlspecialchars($linha['id']) . "\">Excluir</a><br>";
        }
    } catch (PDOException $e) {
        echo "Erro ao conectar: " . $e->getMessage();
    }
    ?>
</div>
</body>
</html>
