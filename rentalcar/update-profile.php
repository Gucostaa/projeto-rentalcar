<?php
session_start(); // Iniciar a sessão
include 'dbconnect.php';

// Verificar se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Atualizar os dados do cliente no banco de dados
    $query = "UPDATE clientes SET nome = :nome, usuario = :usuario, email = :email, telefone = :telefone, senha = :senha, genero = :genero WHERE id = :user_id";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':nome', $_POST['nome']);
    $stmt->bindParam(':usuario', $_POST['usuario']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':telefone', $_POST['telefone']);
    // Verificar se a senha foi fornecida
    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da nova senha
        $stmt->bindParam(':senha', $senha);
    } else {
        // Se a senha não foi fornecida, manter a senha atual
        $query_get_current_password = "SELECT senha FROM clientes WHERE id = :user_id";
        $stmt_get_current_password = $con->prepare($query_get_current_password);
        $stmt_get_current_password->bindParam(':user_id', $_SESSION['user_id']);
        $stmt_get_current_password->execute();
        $current_password = $stmt_get_current_password->fetchColumn();
        $stmt->bindParam(':senha', $current_password);
    }
    $stmt->bindParam(':genero', $_POST['genero']);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    
    if ($stmt->execute()) {
        echo "Perfil atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o perfil.";
    }
}
?>
