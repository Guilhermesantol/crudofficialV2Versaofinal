<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no,
          initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/pico.amber.min.css">
    <title>Atualizar Usuário</title>
</head>
<body>
<h1>Atualizar Usuário</h1>
<?php
try {
    $con = new PDO("mysql:host=localhost;dbname=banco_aula", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false) {
        echo "ID inválido!";
        exit();
    }

    $stmt = $con->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($usuario === false) {
        echo "Usuário não encontrado!";
        exit();
    }
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    exit();
}
?>
<form action="update.php" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>">
    <br>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>">
    <br>
    <input type="submit" value="Atualizar">
</form>
</body>
</html>
