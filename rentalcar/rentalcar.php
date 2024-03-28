<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <link rel="stylesheet" href="style.css">
    <script src="scroll.js"></script>
    <script src="cache.js"></script>
    <script src="script.js"></script>
    <title>RentCar</title>
</head>
<body>
  <section class="section1">
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
            <nav>
            <div class="navbar-login">
              <ul class="navbar-log">
                <li class="nav-item">
                  <a href="#" target="_self" class="nav-link"><i class="faz fa-address-card"></i> Login</a>
                </li>
                <li class="nav-item-reg">
                  <a href="#" target="_self" class="nav-link-reg"><i class="faz fa-file-alt"></i> Registre-se</a>
                </li>
              </ul>
            </div>
          </nav>
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
        <p>Apresentamos a RentCar, especializada em vendas de carros usados. Nossa missão é oferecer veículos de qualidade a preços competitivos, com um serviço personalizado e dedicado à satisfação do cliente em todas as etapas da compra.
        </p>
      </div>
    </div>
  </aside>
<div class="aside-btn">
    <ul class="aside-btn-list">
        <li><button type="button" class="btn-book-virtual">Book Virtual</button></li>
        <li><button type="button" class="btn-leia-mais">Leia Mais</button></li>
    </ul>
</div>

<section class="section2"> 
    <h2>Selecione seu carro</h2>
    <form action="search.php" method="POST">
      <div class="dropdown-container">
        <!-- Dropdown list para Tipo -->
        <h3>Selecione o tipo do carro:</h3>
            <select name="tipo_carro" id="tipo_carro">
                <option value=""></option>
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

      <div class="dropdown-container">
        <!-- Dropdown list para Ano -->
        <h3>Selecione o ano do carro:</h3>
        <select name="ano_carro" id="ano_carro">
            <option value=""></option>
          <?php
            // Executando consulta SQL para obter os anos de carro do banco de dados
            try {
                $stmt = $con->query("SELECT DISTINCT nome FROM ano");
                $anos_carro = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Verificando se há resultados
                if ($anos_carro) {
                    foreach ($anos_carro as $ano) {
                        echo "<option value=\"{$ano['nome']}\">{$ano['nome']}</option>";
                    }
                } else {
                    echo "<option value=\"\">Nenhum ano encontrado</option>";
                }
            } catch (PDOException $e) {
                echo "Erro na consulta: " . $e->getMessage();
                exit();
            }
          ?>
        </select>
      </div>

      <button type="submit" id="searchButton">Buscar</button> <!-- Botão de busca -->
    </form>
  </section>

  <section>
    <div class="plan-trip">
      <p>Planeje sua <b class="htext">viagem</b> agora!
      </p>
    </div>
    <div class="plan-rent">
      <p>Na <b class="htext">RentCar</b> com Agilidade e Segurança</p>     
    </div>
    <div class="container">
      <img src="images/img1.png" height="200" width="200" />
      <p class="container-title">Selecione seu carro<p>
      <p class="container-p"> Escolha entre uma variedade de veículos paraatender às suas necessidades.</p>
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
  </section>

  <section class="carmodels">
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

<footer class="footer2">
<div class="departments">
        <div>
          <p>Vendas</p>
            <li>Carros Novos</li>
            <li>Carros Usados</li>
            <li>Leasing e Financiamento</li>
            <li>Venda de Hatch</li>
            <li>Venda de SUV</li>
            <li>Venda de Sedan</li>
            <li>Venda de Crossover</li>
            <li>Venda de Minivan</li>
            <li>Venda de Picape</li>
        </div>
        <div>
            <p>Serviços</p>           
            <li>Manutenção e Reparos</li>
            <li>Assistência 24 horas</li>
            <li>Estética Automotiva</li>
            <li>Personalização</li>
            <li>Seguro Veicular</li>
            <li>Consultoria de Compra</li>
            <li>Test Drive</li>
            <li>Garantia Estendida</li>
            <li>Revisão de Documentação</li>
            <li>Troca de Peças</li>
            <li>Inspeção Veicular</li>
            <li>Reparo de Pneus</li>
            <li>Diagnóstico Eletrônico</li>
        </div>
        <div>
            <p>Acessórios</p> 
            <li>GPS</li>
            <li>Cadeirinha de Bebê</li>
            <li>Assento de Elevação</li>
            <li>Porta-Bicicletas</li>
            <li>Bagageiro de Teto</li>
            <li>Câmera de Ré</li>
            <li>Sensor de Estacionamento</li>
            <li>Engate de Reboque</li>
            <li>Capota Marítima</li>
            <li>Estribo Lateral</li>
            <li>Faróis de LED</li>
            <li>Kit de Ferramentas</li>
            <li>Protetor de Cárter</li>
            <li>Alarme Veicular</li>
            <li>Central Multimídia</li>         
        </div>
        <div>
            <p>Atendimento ao Cliente</p>           
            <li>Fale Conosco</li>
            <li>Política de Troca</li>
            <li>Perguntas Frequentes</li>
            <li>Comentários e Sugestões</li>
            <li>Feedback do Cliente</li>
            <li>Cancelamento de Pedido</li>
            <li>Devolução de Produto</li>
            <li>Suporte Técnico</li>
            <li>Reclamações</li>
            <li>Reservas e Agendamentos</li>
            <li>Feedback de Serviço</li>
            <li>Relatório de Erros</li>
            <li>Política de Reembolso</li>
            <li>Política de Privacidade</li>
            <li>Termos de Uso</li>
        </div>
        <div>
            <p>Informações Legais</p>
            <li>Termos de Serviço</li>
            <li>Política de Privacidade</li>
            <li>Termos de Garantia</li>
            <li>Avisos Legais</li>
            <li>Política de Cookies</li>
            <li>Política de Devolução</li>
            <li>Política de Reembolso</li>
            <li>Política de Entrega</li>
            <li>Termos e Condições</li>
            <li>Direitos Autorais</li>
            <li>Política de Segurança</li>
            <li>Leis de Proteção ao Consumidor</li>
            <li>Leis de Propriedade Intelectual</li>
            <li>Leis de Defesa do Consumidor</li>
        </div>
        <!-- Adicione mais itens conforme necessário -->
    </div>
    <div class="contact">
        <p>Horário de Atendimento:</p>
        <p>08:00 às 20:00 - Segunda a Sábado, horário local (Exceto domingo e feriados)</p>
        <div class="info-footer">
            <p>Endereço:</p>
            <p>Rua Principal, 1234 - Centro</p>
            <p>Cidade, Estado - CEP: 12345-678</p>
        </div>
        <div class="info-footer">
            <p>Central de Atendimento:</p>
            <p>(00) 1234-5678</p> <!-- Adicionando espaço após os dois pontos -->
        </div>
        <div class="info-footer">
            <p>Email:</p>
            <p>contato@rentcar.com</p> <!-- Adicionando espaço após os dois pontos -->
        </div>
        <div>
        <p>Redes Sociais:</p>
        <ul>
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Instagram</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">LinkedIn</a></li>
        </ul>
      </div>
      <div>
        <p>Baixe nosso App:</p>
        <ul>
            <li><a href="#">iOS</a></li>
            <li><a href="#">Android</a></li>
        </ul>
      </div>
    </div>
</footer>

</body>
</html>