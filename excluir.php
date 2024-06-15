<?php

$con = new PDO ("mysql:host=localhost;dbname=banco_aula","root", "");

if (isset($_GET["id"])){
    $id = $_GET["id"];
    $con->exec("DELETE FROM usuarios WHERE id = $id");
    echo "Exclusão realizada com sucesso!";
    require 'pagina.php';

}
