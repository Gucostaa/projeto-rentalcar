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
                        <a href="#" target="_self" class="nav-link" onclick="openLoginPopup()"><i class="faz fa-address-card"></i> Login</a>
                    </li>
                    <li class="nav-item-reg">
                        <a href="#" target="_self" class="nav-link-reg"><i class="faz fa-file-alt"></i> Registre-se</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</section>

<div class="login-popup" id="loginPopup">
    <div class="login-popup-content">
        <span class="close-login" onclick="closeLoginPopup()">&times;</span>
        <form id="loginForm">
            <input type="text" placeholder="Nome" id="username">
            <input type="password" placeholder="Senha" id="password">
            <button type="submit">Entrar</button>
        </form>
        <a href="#">Já possui uma conta?</a>
        <button onclick="openRegisterForm()">Cadastrar</button>
    </div>
</div>
