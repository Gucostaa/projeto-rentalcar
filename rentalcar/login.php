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

        if ($user) { 
            if (password_verify($senha, $user['senha'])) { 
                // Senha correta, faça o que precisar aqui, como redirecionar para logged.php
                header('Location: logged.php');
                exit(); 
            } else {
                // Senha incorreta, exibirá o alerta no frontend
                echo "<script>displayPopup('Usuário ou senha incorretos. Tente novamente.');</script>";
            }
        } else {
            // Usuário não encontrado, exibirá o alerta no frontend
            echo "<script>displayPopup('Usuário ou senha incorretos. Tente novamente.');</script>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
