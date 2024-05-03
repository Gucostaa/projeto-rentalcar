<?php
include 'dbconnect.php';

// Iniciar a sessão
session_start();

// Verificar se o ID do usuário está na sessão
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

// Consulta para obter os dados do cliente com base no ID do usuário na sessão
$query = "SELECT nome, usuario, email, telefone, senha, genero, caminho_imagem FROM clientes WHERE id = :user_id";
$stmt = $con->prepare($query);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/profile.css">
    <title>Perfil</title>
</head>
<body>
<div class="container">
    <div class="image">
        <?php if(isset($cliente['caminho_imagem']) && !empty($cliente['caminho_imagem'])): ?>
            <img id="show-login" src="<?php echo $cliente['caminho_imagem']; ?>" alt="">
        <?php else: ?>
            <img id="show-login" src="images/default-image.png" alt="Imagem padrão do perfil">
        <?php endif; ?>
    </div>


    <div class="popup">
        <div class="close-btn">&times;</div>
        <div class="form">
            <form id="loginForm" method="post" enctype="multipart/form-data" action="upload-image.php">
                <div>
                    <h2>Foto do Perfil</h2>
                    <p>Uma foto ajuda as pessoas a reconhecerem você e permite que você saiba quando a conta está conectada</p>
                </div>
                <div class="popup-image">
                    <?php if(isset($cliente['caminho_imagem']) && !empty($cliente['caminho_imagem'])): ?>
                        <img id="popup-img" src="<?php echo $cliente['caminho_imagem']; ?>" alt="">
                    <?php else: ?>
                        <img id="popup-img" src="images/default-image.png" alt="Imagem padrão do perfil">
                    <?php endif; ?>
                </div>
                <div class="popup-container">
                    <input type="file" id="profile-image" name="profile_image" accept="image/*">
                    <button class="update-img" type="submit" name="submit">Adicionar foto do perfil</button>
                </div>
            </form>   
        </div>     
    </div>

    <form action="profile.php" method="post">
        <h2>Seu Perfil</h2>
        <div class="content">
            <div class="input-box">
                <label for="nome">Nome Completo</label>
                <input type="text" placeholder="Digite o nome completo" name="nome" value="<?php echo $cliente['nome']; ?>" readonly>
            </div>
            <div class="input-box">
                <label for="usuario">Nome de Usuário</label>
                <input type="text" placeholder="Digite o nome de usuário" name="usuario" value="<?php echo $cliente['usuario']; ?>" readonly>
            </div>
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" placeholder="Digite o email" name="email" value="<?php echo $cliente['email']; ?>" readonly>
            </div>
            <div class="input-box">
                <label for="telefone">Número de Telefone</label>
                <input type="tel" placeholder="Digite o número de telefone" name="telefone" value="<?php echo $cliente['telefone']; ?>" readonly>
            </div>
            <div class="input-box">
                <label for="senha">Senha</label>
                <input type="password" placeholder="Digite a nova senha" name="senha" value="">
            </div>
            <div class="input-box">
                <label for="genero">Gênero</label>
                <select name="genero" class="styled-select">
                    <option value="Masculino" <?php if ($cliente['genero'] === 'Masculino') echo 'selected'; ?>>Masculino</option>
                    <option value="Feminino" <?php if ($cliente['genero'] === 'Feminino') echo 'selected'; ?>>Feminino</option>
                    <option value="Outro" <?php if ($cliente['genero'] === 'Outro') echo 'selected'; ?>>Outro</option>
                </select>
            </div>
        </div>
        <div class="button-container">
            <button class="edit" type="button" onclick="editProfile()">Editar</button>
            <button class="save" type="button"  onclick="saveProfile()">Salvar</button>
        </div>
    </form>
</div>

<script src="JavaScript/upload-image.js"></script>
<script src="JavaScript/profile-popup.js"></script>
</body>
</html>
