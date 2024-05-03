<?php
include 'dbconnect.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $targetDir = "images/";
    $targetFile = $targetDir . basename($_FILES["profile_image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar se o arquivo é uma imagem
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
        exit();
    }

    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
        // Atualizar o caminho da imagem no banco de dados
        $updateQuery = "UPDATE clientes SET caminho_imagem = :caminho_imagem WHERE id = :user_id";
        $stmt = $con->prepare($updateQuery);
        $stmt->bindParam(':caminho_imagem', $targetFile);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();

        header("Location: profile.php");
        exit();
    } else {
        echo "Houve um erro ao fazer upload do arquivo.";
    }
}
?>