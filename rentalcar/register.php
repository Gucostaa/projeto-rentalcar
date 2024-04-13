<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="register.css">
    <title>Registre-se</title>
</head>
<body>
    <div class="container">
        <form action="register.php" method="post">
            <h2>Registre-se</h2>
            <div class="content">
                <div class="input-box">
                    <label for="nome">Nome Completo</label>
                    <input type="text" placeholder="Enter full name" name="nome" required>
                </div>
                <div class="input-box">
                    <label for="usuario">Nome de Usuário</label>
                    <input type="text" placeholder="Enter username" name="usuario" required>
                </div>
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" placeholder="Enter your valid email" name="email" required>
                </div>
                <div class="input-box">
                    <label for="telefone">Número de Telefone</label>
                    <input type="tel" placeholder="Enter phone number" name="telefone" required>
                </div>
                <div class="input-box">
                    <label for="senha">Senha</label>
                    <input type="password" placeholder="Enter new password" name="senha" required>
                </div>
                <div class="input-box">
                    <label for="csenha">Confirmar Senha</label>
                    <input type="password" placeholder="Confirm password" name="csenha" required>
                </div>
                <span class="gender-title">Genero</span>
                <div class="gender-category">
                    <input type="radio" name="genero" id="male" value="Masculino">
                    <label for="male">Masculino</label>
                    <input type="radio" name="genero" id="female" value="Feminino">
                    <label for="female">Feminino</label>
                    <input type="radio" name="genero" id="other" value="Outro">
                    <label for="other">Outro</label>
                </div>
            </div>
            <div class="alert">
                <p>By clicking Sign Up, you agree to our <a href="#">Terms</a>, <a href="#">Privacy Policy</a> and <a href="#">Cookies Policy</a>, You may receive SMS notifications from us and can opt out at any time.</p>
            </div>
            <div class="button-container">
                <button type="submit">Registre-se</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
include 'dbconnect.php';

date_default_timezone_set('America/Sao_Paulo');

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber dados do formulário
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $csenha = $_POST['csenha'];
    $genero = $_POST['genero'];
    $data_inclusao = date("Y-m-d");
    
    // Verificar se a senha e a confirmação da senha coincidem
    if ($senha !== $csenha) {
        echo "A senha e a confirmação da senha não coincidem.";
    } else {
        // Gerar hash da senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        
        // Preparar e executar a consulta SQL para inserir dados
        $stmt = $con->prepare("INSERT INTO clientes (nome, usuario, email, telefone, senha, genero, data_inclusao) VALUES (:nome, :usuario, :email, :telefone, :senha, :genero, :data_inclusao)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':senha', $senha_hash); // Salvar o hash da senha no banco de dados
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':data_inclusao', $data_inclusao);

        if ($stmt->execute()) {
            echo "Registro bem-sucedido!";
        } else {
            echo "Erro ao registrar: " . $stmt->error;
        }

        // Fechar a conexão
        $con = null;
    }
}
?>

