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
<a href="logged.php"><img class="return" src="images/return.png" alt="return"></a>
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
                <input type="password" placeholder="Digite a nova senha" name="senha" value="" readonly>
            </div>
            <div class="input-box">
                <label for="genero">Gênero</label>
                <select name="genero" class="styled-select" readonly>
                    <option value="Masculino" <?php if ($cliente['genero'] === 'Masculino') echo 'selected'; ?>>Masculino</option>
                    <option value="Feminino" <?php if ($cliente['genero'] === 'Feminino') echo 'selected'; ?>>Feminino</option>
                    <option value="Outro" <?php if ($cliente['genero'] === 'Outro') echo 'selected'; ?>>Outro</option>
                </select>
            </div>
        </div>
        <div class="button-container">
            <button class="edit" type="button" onclick="editProfile()">Editar</button>
            <button class="save" type="button" disabled onclick="saveProfile()">Salvar</button>
        </div>
    </form>
</div>

<script>
    var generoOriginal = '<?php echo $cliente['genero']; ?>'; // Armazenar o valor original do gênero

    function editProfile() {
    // Habilitar a edição dos campos
    var inputs = document.querySelectorAll('input[readonly]');
    inputs.forEach(function(input) {
        input.removeAttribute('readonly');
    });

    // Habilitar a edição do campo de senha
    document.querySelector('input[name="senha"]').removeAttribute('readonly');

    // Habilitar a edição do campo de gênero
    var selectGenero = document.querySelector('select[name="genero"]');
    for (var i = 0; i < selectGenero.options.length; i++) {
        selectGenero.options[i].disabled = false;
    }

    // Ativar o botão de salvar
    document.querySelector('.save').removeAttribute('disabled');

    // Ocultar o botão de editar
    document.querySelector('.edit').style.display = 'none';
}

function saveProfile() {
    // Obter os valores dos campos
    var nome = document.querySelector('input[name="nome"]').value;
    var usuario = document.querySelector('input[name="usuario"]').value;
    var email = document.querySelector('input[name="email"]').value;
    var telefone = document.querySelector('input[name="telefone"]').value;
    var senha = document.querySelector('input[name="senha"]').value;
    var genero = document.querySelector('select[name="genero"]').value;

    // Verificar se houve alterações nos campos de senha e gênero
    var senhaModificada = senha !== ''; // Se a senha não estiver vazia, foi modificada
    var generoModificado = genero !== generoOriginal; // Verificar se o gênero foi modificado

    // Enviar os dados para o script PHP via AJAX apenas se foram modificados
    if (senhaModificada || generoModificado) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update-profile.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Exibir uma mensagem ou redirecionar o usuário após a atualização
                alert(xhr.responseText);
                // Limpar o campo de senha após salvar os dados do perfil
                document.querySelector('input[name="senha"]').value = '';

                // Recarregar a página após a atualização (opcional)
                location.reload();
            }
        };
        xhr.send('nome=' + encodeURIComponent(nome) + '&usuario=' + encodeURIComponent(usuario) + '&email=' + encodeURIComponent(email) + '&telefone=' + encodeURIComponent(telefone) + '&senha=' + encodeURIComponent(senha) + '&genero=' + encodeURIComponent(genero));
    } else {
        // Se nenhum campo foi modificado, apenas retornar
        alert("Nenhuma modificação feita.");
    }

    // Desativar o botão de salvar após salvar os dados
    document.querySelector('.save').setAttribute('disabled', 'disabled');
}

// Desabilitar as opções de gênero, exceto a originalmente selecionada
document.addEventListener("DOMContentLoaded", function() {
    var selectGenero = document.querySelector('select[name="genero"]');
    for (var i = 0; i < selectGenero.options.length; i++) {
        if (selectGenero.options[i].value !== generoOriginal) {
            selectGenero.options[i].disabled = true;
        }
    }
});
</script>

<script src="JavaScript/upload-image.js"></script>
<script src="JavaScript/profile-popup.js"></script>
</body>
</html>
