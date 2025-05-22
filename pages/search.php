<?php
// Incluindo o arquivo de conexão com o banco de dados
include 'dbconnect.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todas as variáveis do formulário foram recebidas
    if (isset($_POST["tipo_carro"]) && isset($_POST["marca_carro"]) && isset($_POST["ano_carro"])) {
        // Obtém os valores selecionados
        $tipo_carro = $_POST["tipo_carro"];
        $marca_carro = $_POST["marca_carro"];
        $ano_carro = $_POST["ano_carro"];

        try {
            // Construir e executar a consulta SQL para buscar informações dos carros
            $sql = "SELECT c.*, m.nome as marca_nome, t.nome as tipo_nome, a.nome as ano_nome
                    FROM carros c
                    JOIN marca m ON c.marca_id = m.id
                    JOIN tipo t ON c.tipo_id = t.id
                    JOIN ano a ON c.ano_id = a.id
                    WHERE t.nome = :tipo_carro AND m.nome = :marca_carro AND a.nome = :ano_carro";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':tipo_carro', $tipo_carro);
            $stmt->bindParam(':marca_carro', $marca_carro);
            $stmt->bindParam(':ano_carro', $ano_carro);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Exibir os resultados da consulta
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<p>Nome: " . $row["nome"] . "</p>";
                    echo "<p>Marca: " . $row["marca_nome"] . "</p>";
                    echo "<p>Tipo: " . $row["tipo_nome"] . "</p>";
                    echo "<p>Ano: " . $row["ano_nome"] . "</p>";
                    echo "<p>Preço: $" . $row["preco"] . "</p>";
                    echo "<p>Quilometragem: " . $row["quilometragem"] . " km</p>";
                    echo "<p>Acessórios: " . $row["acessorios"] . "</p>";
                    echo "<p>Câmbio: " . $row["cambio"] . "</p>";
                    echo "<p><img src='" . $row["caminho_imagem"] . "' alt='" . $row["nome"] . "'></p>"; // Exibindo a imagem do carro
                }
            } else {
                echo "Nenhum resultado encontrado.";
            }
        } catch (PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
            exit();
        }
    } else {
        // Se algum campo estiver faltando, exibe uma mensagem de erro
        echo "Erro: Todos os campos do formulário devem ser preenchidos.";
    }
} else {
    // Se o formulário não foi submetido via POST, redireciona para a página inicial ou exibe uma mensagem de erro
    echo "Erro: O formulário não foi submetido corretamente.";
}
?>