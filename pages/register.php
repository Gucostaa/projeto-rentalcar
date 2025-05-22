<?php
include 'dbconnect.php';

date_default_timezone_set('America/Sao_Paulo');

// Initialize variables
$registration_success = false;
$error_message = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $csenha = $_POST['csenha'];
    $genero = $_POST['genero'];
    $data_inclusao = date("Y-m-d");

    // Check if both password fields are filled
    if (!empty($senha) && !empty($csenha)) {
        // Check if password and confirm password match
        if ($senha !== $csenha) {
            $error_message = "As senhas não coincidem.";
        }
    }

    if (empty($error_message)) {
        // Hash the password
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Prepare and execute SQL statement to insert data
        $stmt = $con->prepare("INSERT INTO clientes (nome, usuario, email, telefone, senha, genero, data_inclusao) VALUES (:nome, :usuario, :email, :telefone, :senha, :genero, :data_inclusao)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':senha', $senha_hash); // Save hashed password in the database
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':data_inclusao', $data_inclusao);

        if ($stmt->execute()) {
            $registration_success = true;
        } else {
            $error_message = "Erro ao registrar: " . $stmt->error;
        }

        // Close the connection
        $con = null;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/register.css">
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
                    <input type="radio" name="genero" id="male" value="Masculino" required>
                    <label for="male">Masculino</label>
                    <input type="radio" name="genero" id="female" value="Feminino" required>
                    <label for="female">Feminino</label>
                    <input type="radio" name="genero" id="other" value="Outro" required>
                    <label for="other">Outro</label>
                </div>
            </div>
            <div class="alert">
                <?php if ($registration_success === true) { ?>
                <p class="success-message">Registro bem-sucedido!</p>
                <?php } elseif (!empty($error_message)) { ?>
                <p class="failure-message"><?php echo $error_message; ?></p>
                <?php } ?>
                <p>By clicking Sign Up, you agree to our <a href="#">Terms</a>, <a href="#">Privacy Policy</a> and <a href="#">Cookies Policy</a>, You may receive SMS notifications from us and can opt out at any time.</p>
            </div>
            <div class="button-container">
                <button type="submit">Registre-se</button>
            </div>
        </form>
    </div>

    <script src="JavaScript/close-register.js"></script>
</body>
</html>
