<?php
if (isset($_POST['id-input']) && isset($_POST['alterar-input']) && isset($_POST['novovalor-input'])){
$dados = [
        ':id' => $_POST['id-input'],
        ':novovalor' => $_POST['novovalor-input']
];

$alterar = $_POST['alterar-input'];
$PDO = new PDO("mysql:host=localhost;dbname=banco_aula", "root", "");
  $sql = "UPDATE usuarios SET $alterar = :novovalor WHERE id = :id";
  $EDITAR = $PDO->prepare($sql);
  $EDITAR->execute($dados);
  $msgvalidação= "O usuario foi atualizado com sucesso!";
}?>

global$resultado; <!doctype html>
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
<p> <?php echo $msgvalidação;?> </p>
<form action="pagina.php" method=post>
    <label for="id de usuario">id de usuario</label>
    <input type="text" id="id" name="id-input">

    <label for="coluna e alterar">coluna a ser alterada</label>
    <input type="text" id="alterar" name="alterar-input">

    <label for="novovalor">novo valor</label>
    <input type="text" id="novovalor" name="novovalor-input">
    <input type="submit" value="enviar
">


</form>
<?php
$con = new PDO('mysql:host=localhost;dbname=banco_aula', 'root', '');
$resultado = $con->query("SELECT * FROM usuarios");
while ($linha = $resultado->fetch()) {
    echo $linha['nome'] . " - " . $linha['email'] . " - " . "<a href=\"pagina.php?id=" . $linha['id'] . "\">Atualizar</a>."
        . " - " . "<a href=\"excluir.php?id=" . $linha['id'] . "\">Excluir</a><br>";
}

?>
</body>
</html>
