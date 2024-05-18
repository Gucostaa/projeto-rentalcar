<?php
// Incluir o arquivo de conexão com o banco de dados
include 'dbconnect.php';

// Iniciar a sessão
session_start();

// Verificar se o ID do usuário está na sessão
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

// Consulta para obter o caminho da imagem do cliente com base no ID do usuário na sessão
$query = "SELECT caminho_imagem FROM clientes WHERE id = :user_id";
$stmt = $con->prepare($query);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?php
// Incluindo o arquivo de conexão com o banco de dados
include 'dbconnect.php';

// Variável para armazenar os resultados da busca
$search_results = array(); // Inicialize como um array vazio

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos do formulário foram preenchidos
    if (isset($_POST["tipo_carro"]) && isset($_POST["marca_carro"])) {
        // Obtém os valores selecionados
        $tipo_carro = $_POST["tipo_carro"];
        $marca_carro = $_POST["marca_carro"];

        try {
            // Construir e executar a consulta SQL para buscar informações dos carros
            $sql = "SELECT c.*, m.nome as marca_nome, t.nome as tipo_nome, a.nome as ano_nome,
                           co.nome as cor_nome, c.caminho_imagem
                    FROM carros c
                    JOIN marca m ON c.marca_id = m.id
                    JOIN tipo t ON c.tipo_id = t.id
                    LEFT JOIN ano a ON c.ano_id = a.id
                    LEFT JOIN cor co ON c.cor_id = co.id
                    WHERE t.nome = :tipo_carro AND m.nome = :marca_carro";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':tipo_carro', $tipo_carro);
            $stmt->bindParam(':marca_carro', $marca_carro);
            $stmt->execute();
          
            if ($stmt->rowCount() > 0) {
                // Adicione cada resultado de carro à array $search_results
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $search_results[] = $row;
                }
            } else {
                $search_results[] = "<p class='col'>Nenhum resultado encontrado.</p>";
            }
        } catch (PDOException $e) {
            $search_results[] = "<p class='col'>Erro na consulta: " . $e->getMessage() . "</p>";
        }
    } else {
        // Se algum campo estiver faltando, exibe uma mensagem de erro
        $search_results[] = "<p class='col'>Erro: Todos os campos do formulário devem ser preenchidos.</p>";
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
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0" />
    <link rel="stylesheet" href="CSS/logged.css">
    <title>RentCar</title>
</head>
<body>
  <section class="header-container">
  <div class="logo">
      <img src="images/rentcar150.png" alt="logo">
    </div>
      <header>
          <nav>
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a href="#" target="_self" class="nav-link"><i class="faz fa-address-card"></i> Sobre Nós</a>
                </li>
                <li class="nav-item">
                  <a href="#" target="_self" class="nav-link"><i class="faz fa-file-alt"></i> Veículos</a>
                </li>
                <li class="nav-item">
                  <a href="#" target="_self" class="nav-link"><i class="faz fa-envelope"></i> Serviços & Garantias</a>
                </li>
                <li class="nav-item">
                  <a href="#" target="_self" class="nav-link"><i class="faz fa-envelope"></i> Contatos</a>
                </li>
                <li class="nav-item">
                  <a href="#" target="_self" class="nav-link"><i class="faz fa-envelope"></i> FAQ</a>
                </li>
              </ul>
            </nav>

<div class="profile">
    <a href="profile.php">
        <div class="profile-image-container">
            <?php if(isset($cliente['caminho_imagem']) && !empty($cliente['caminho_imagem'])): ?>
                <img src="<?php echo $cliente['caminho_imagem']; ?>" alt="Perfil" class="profile-image">
            <?php else: ?>
                <img src="images/default-image2.png" alt="Imagem padrão" class="profile-image">
            <?php endif; ?>
        </div>
    </a>
</div>
</header>   
  
  </section>
  <div class="hr">
    <hr>
  </div>

  <article>
    <div class="hyundai-car">
      <img src="images/car2.png" alt="hyundai-car">
    </div>
  </article>
  
  <aside>
    <div class="aside-content">
      <div class="p1">
        <p>Planeje sua <b class="htext">viagem</b> agora!</p>
      </div>
      <div class="p2">
        <p>Economize muito mais <b class="htext">comprando</b> na RentCar!</p>
      </div>
      <div class="p3">
        <p>Apresentamos a RentCar, especializada em vendas de carros usados. Nossa missão <br> é oferecer veículos de qualidade a preços competitivos, com um serviço personalizado <br> e dedicado à satisfação do cliente em todas as etapas da compra.
        </p>
      </div>
    </div>
  </aside>
<div class="aside-btn">
    <ul class="aside-btn-list">
        <li><button type="button" class="btn-book-virtual">Test Drive</button></li>
        <li><button type="button" class="btn-leia-mais">Veículos</button></li>
    </ul>
</div>

<section class="search-car"> 
    <h2>Selecione seu carro</h2>
    <form method="POST">
      <div class="dropdown-container">
        <!-- Dropdown list para Tipo -->
        <h3>Selecione o tipo do carro:</h3>
            <select name="tipo_carro" id="tipo_carro">
                <option value=""></option>
                <?php
                // Loop para exibir opções de tipos de carro
                foreach ($tipos_carro as $tipo) {
                    echo "<option value=\"{$tipo['nome']}\">{$tipo['nome']}</option>";
                }
                ?>
              <?php
                // Incluindo o arquivo de conexão com o banco de dados
                include 'dbconnect.php';

                // Executando consulta SQL para obter os tipos de carro do banco de dados
                try {
                    $stmt = $con->query("SELECT DISTINCT nome FROM tipo");
                    $tipos_carro = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    // Verificando se há resultados
                    if ($tipos_carro) {
                        foreach ($tipos_carro as $tipo) {
                            echo "<option value=\"{$tipo['nome']}\">{$tipo['nome']}</option>";
                        }
                    } else {
                        echo "<option value=\"\">Nenhum tipo encontrado</option>";
                    }
                } catch (PDOException $e) {
                    echo "Erro na consulta: " . $e->getMessage();
                    exit();
                }
              ?>
          <!-- Opções preenchidas dinamicamente do banco de dados -->
        </select>
      </div>

      <div class="dropdown-container">
        <!-- Dropdown list para Marca -->
        <h3>Selecione a marca do carro:</h3>
        <select name="marca_carro" id="marca_carro">
            <option value=""></option>
          <?php
            // Executando consulta SQL para obter as marcas de carro do banco de dados
            try {
                $stmt = $con->query("SELECT DISTINCT nome FROM marca");
                $marcas_carro = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Verificando se há resultados
                if ($marcas_carro) {
                    foreach ($marcas_carro as $marca) {
                        echo "<option value=\"{$marca['nome']}\">{$marca['nome']}</option>";
                    }
                } else {
                    echo "<option value=\"\">Nenhuma marca encontrada</option>";
                }
            } catch (PDOException $e) {
                echo "Erro na consulta: " . $e->getMessage();
                exit();
            }
          ?>
          <!-- Opções preenchidas dinamicamente do banco de dados -->
        </select>
      </div>

      <button type="submit" id="searchButton">Buscar</button> <!-- Botão de busca -->
    </form>
    <section class="search-results-container">
    <div class="search-results row">
        <?php
        foreach ($search_results as $result) {
            // Verifica se $result é um array
            if (is_array($result)) {
                // Exibe as informações sobre o carro
                echo "<div class='car'>";
                echo "<img src='images/cars/" . $result['caminho_imagem'] . "' class='card-img-top' alt='Imagem do Produto'>";
                echo "<div class='car-info'>"; // Contêiner para as informações do carro
                echo "<p>Marca: " . $result['marca_nome'] . "</p>";
                echo "<p>Ano: " . $result['ano_nome'] . "</p>";
                echo "<p>Preço: R$ " . number_format($result['preco'], 2, ',', '.') . "</p>";
                echo "<p>Cor: " . $result['cor_nome'] . "</p>";
                echo "<p>Acessórios: " . $result['acessorios'] . "</p>";
                echo "<p>Câmbio: " . $result['cambio'] . "</p>";
                echo "<p>Quilometragem: " . $result['quilometragem'] . "</p>";
                // Adicione outras informações conforme necessário
                echo "</div>"; // Fecha o contêiner de informações do carro
                echo "</div>"; // Fecha o contêiner do carro
            } else {
                // Se for uma string (mensagem de erro), exibe a mensagem
                echo "<p class='col'>$result</p>";
            }
        }
        ?>
    </div>
</section>
  </section>

  <section>
    <div class="plan-trip">
      <p>Planeje sua <b class="htext">viagem</b> agora!
      </p>
    </div>
    <div class="plan-rent">
      <p>Na <b class="htext">RentCar</b> com Agilidade e Segurança</p>     
    </div>
    <div class="container-wrapper">
      <div class="container">
        <img src="images/img1.png" height="200" width="200" />
        <p class="container-title">Selecione seu carro<p>
        <p class="container-p"> Escolha entre uma variedade de veículos para atender às suas necessidades.</p>
      </div>
      <div class="container">
        <img src="images/img2.png" height="200" width="200" />
        <p class="container-title">Contate o operador</p>
        <p class="container-p"> Entre em contato com nossos operadores para obter assistência na sua compra.</p>
      </div>
      <div class="container">
        <img src="images/img3.png" height="200" width="200" />
        <p class="container-title">Vamos dirigir!</p>
        <p class="container-p"> Desfrute da sua nova aquisição e dasatisfação de ter feito uma ótima escolha!</p>
      </div>
    </div>
  </section>

  <section>
  <section>
    <div class="plan-trip">
      <p>Modelos de<b class="htext"> veículos</b></p>
    </div>
    <div class="plan-rent">
      <p>Exibição de modelos da <b class="htext">RentCar</b></p>
    </div>
  </section>
  <div class="container-img">
    <div class="scroll-container">
      <img src="images/hatch.png" alt="Hatch" />
      <img src="images/sedan.png" alt="Sedan" />
      <img src="images/suv.png" alt="SUV" />
      <img src="images/crossover.png" alt="Crossover" />
      <img src="images/minivan.png" alt="Minivan" />
      <img src="images/picape.png" alt="Picape" />
    </div>
  </div>
</section>



<footer class="footer">
    <div class="f-oferts">
        <h2>RentCar News!</h2>
        <form class="subscribe-form" action="#" method="post">
            <input class="textbox" type="text" name="nome" placeholder="Seu Nome">
            <input class="textbox" type="email" name="email" placeholder="Seu Email">
            <input class="textbutton" type="submit" value="Inscrever-se">
        </form>
    </div>
</footer>

<footer class="footer">
  <div class="footer-container">
    <ul>
      <h3>RentCar</h3>  
      <p>Siga-nos nas redes sociais para acesso antecipado a descontos, promoções relâmpago e novidades irresistíveis.</p>
      <div class="social-media">
      <img src="images/instagram.png" alt="instagram">
        <img src="images/facebook.png" alt="facebook">
        <img src="images/twitter.png" alt="twitter">
        <img src="images/linkedin.png" alt="linkedin">
      </div>        
    </ul>
      <ul>
      <h3>Links</h3>
        <li><a href="#">Home</a></li>
        <li><a href="#">Preços</a></li>
        <li><a href="#">Baixar</a></li>
        <li><a href="#">Sobre</a></li>
        <li><a href="#">Servicos</a></li>
      </ul>

      <ul>
      <h3>Suporte</h3>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">Como Funciona</a></li>
        <li><a href="#">Características</a></li>
        <li><a href="#">Contato</a></li>
        <li><a href="#">Comunicação</a></li>
      </ul>

      <ul>
      <h3>Contato</h3>
        <li><a href="#">+55 19 93333-3333</a></li>
        <li><a href="#">RentCar@outlook.com</a></li>
        <li><a href="#">Brasil</a></li>
      </ul>
  </div>
</footer>

<script src="JavaScript/scroll.js"></script>
<script src="JavaScript/cache.js"></script>
<script src="JavaScript/script.js"></script>
<script src="JavaScript/popup.js"></script>

<script>
 document.addEventListener("DOMContentLoaded", function() {
    // Função para ajustar a altura do contêiner com base nos resultados da pesquisa
    function ajustarAlturaContainer() {
        // Obter o elemento .search-results-container
        var searchResultsContainer = document.querySelector('.search-results-container');
        // Obter o elemento .search-car
        var searchCarContainer = document.querySelector('.search-car');
        // Verificar se há resultados
        var resultsExist = searchResultsContainer.querySelector('.car') !== null;
        
        // Definir a altura do elemento .search-car com base na presença de resultados
        if (resultsExist) {
            // Se houver resultados, definir altura como 650px
            searchCarContainer.style.height = '1250px';
        } else {
            // Se não houver resultados, definir altura como 350px
            searchCarContainer.style.height = '350px';
        }
    }

    // Chamar a função ao carregar a página
    ajustarAlturaContainer();

    // Opcionalmente, você pode chamar esta função sempre que os resultados da pesquisa mudarem.
});
</script>

</body>
</html>