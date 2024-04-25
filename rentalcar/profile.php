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
$query = "SELECT nome, usuario, email, telefone, senha, genero FROM clientes WHERE id = :user_id";
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
            <img src="images/muielinda.png" alt="" >
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

<script>
    function editProfile() {
        // Habilitar a edição dos campos
        var inputs = document.querySelectorAll('input[readonly]');
        inputs.forEach(function(input) {
            input.removeAttribute('readonly');
        });

        // Mostrar o botão de salvar
        document.querySelector('.edit').style.display = 'none';
        document.querySelector('.save').style.display = 'block';
    }

    function saveProfile() {
    // Obter os valores dos campos
    var nome = document.querySelector('input[name="nome"]').value;
    var usuario = document.querySelector('input[name="usuario"]').value;
    var email = document.querySelector('input[name="email"]').value;
    var telefone = document.querySelector('input[name="telefone"]').value;
    var senha = document.querySelector('input[name="senha"]').value;
    var genero = document.querySelector('select[name="genero"]').value; // Alterado para select

    // Enviar os dados para o script PHP via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update-profile.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Exibir uma mensagem ou redirecionar o usuário após a atualização
            alert(xhr.responseText);
            // Limpar o campo de senha após salvar os dados do perfil
            document.querySelector('input[name="senha"]').value = '';
            
            // Atualizar o valor selecionado no combobox
            var select = document.querySelector('select[name="genero"]');
            var selectedOption = select.querySelector('option[value="' + genero + '"]');
            if (selectedOption) {
                select.value = genero;
            }
            
            // Recarregar a página após a atualização (opcional)
            location.reload();
        }
    };
    xhr.send('nome=' + encodeURIComponent(nome) + '&usuario=' + encodeURIComponent(usuario) + '&email=' + encodeURIComponent(email) + '&telefone=' + encodeURIComponent(telefone) + '&senha=' + encodeURIComponent(senha) + '&genero=' + encodeURIComponent(genero));
}

</script>
</body>
</html>


