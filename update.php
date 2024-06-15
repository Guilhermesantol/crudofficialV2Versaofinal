<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['id'])) {
        try {
            $con = new PDO("mysql:host=localhost;dbname=banco_aula", "root", "");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $novoNome = $_POST['nome'];
            $novoEmail = $_POST['email'];
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

            if ($id === false) {
                throw new Exception("ID inválido");
            }

            // Preparar a query de UPDATE
            $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
            $update = $con->prepare($sql);

            // Associar os parâmetros aos valores
            $update->bindParam(':nome', $novoNome);
            $update->bindParam(':email', $novoEmail);
            $update->bindParam(':id', $id);

            // Executar a query
            if ($update->execute()) {
                echo "Registro atualizado com sucesso!";
            } else {
                echo "Houve um erro ao atualizar o registro!";
            }

            header("Location: pagina.php"); // Redireciona para a página principal
            exit();
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
