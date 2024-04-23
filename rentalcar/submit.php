<?php
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    try {
        $query = "SELECT * FROM clientes WHERE usuario = :usuario LIMIT 1";
        $statement = $con->prepare($query);
        $statement->bindParam(':usuario', $usuario);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) { // Verifica se o usuário existe
            if (password_verify($senha, $user['senha'])) { // Verifica a senha
                echo json_encode(array("success" => true, "message" => "Login bem-sucedido. Bem-vindo, " . $user['usuario'] . "!"));
                exit(); // Importante: encerra a execução do script após retornar a resposta
            } else {
                echo json_encode(array("success" => false, "message" => "Usuário ou senha incorretos. Tente novamente."));
                exit();
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Usuário ou senha incorretos. Tente novamente."));
            exit();
        }
    } catch (PDOException $e) {
        echo json_encode(array("success" => false, "message" => "Erro: " . $e->getMessage()));
        exit();
    }
}
?>