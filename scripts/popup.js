
document.querySelector("#show-login").addEventListener("click", function() {
    document.querySelector(".popup").classList.add("active");
});

document.querySelector(".popup .close-btn").addEventListener("click", function() {
    document.querySelector(".popup").classList.remove("active");
});

// Função para definir o cookie com os dados de login
function setRememberMeCookie(usuario, senha) {
    // Define a data de expiração do cookie para um mês a partir de agora
    var expirationDate = new Date();
    expirationDate.setMonth(expirationDate.getMonth() + 1);

    // Formata os dados de login em uma string para serem armazenados no cookie
    var userData = usuario + '|' + senha;

    // Define o cookie com os dados de login e a data de expiração
    document.cookie = 'loginData=' + userData + '; expires=' + expirationDate.toUTCString() + '; path=/';
}

// Função para obter os dados de login salvos no cookie
function getRememberMeCookie() {
    // Obtém todos os cookies da página
    var cookies = document.cookie.split(';');

    // Procura pelo cookie com os dados de login
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.indexOf('loginData=') === 0) {
            // Extrai os dados de login do cookie
            var userData = cookie.substring('loginData='.length);
            var loginInfo = userData.split('|');

            // Retorna os dados de login como um objeto
            return {
                usuario: loginInfo[0],
                senha: loginInfo[1]
            };
        }
    }

    // Retorna null se nenhum cookie com os dados de login for encontrado
    return null;
}

// Verifica se existe um cookie com os dados de login ao carregar a página
window.addEventListener('load', function() {
    var loginData = getRememberMeCookie();
    if (loginData) {
        // Preenche automaticamente os campos de login com os dados salvos
        document.getElementById('user').value = loginData.usuario;
        document.getElementById('password').value = loginData.senha;
    }
});

// Adiciona um evento de clique ao botão "Entrar"
document.getElementById('btn').addEventListener('click', function() {
    var usuario = document.getElementById('user').value;
    var senha = document.getElementById('password').value;

    // Verifica se a caixa "Remember me" está marcada
    var rememberMeCheckbox = document.getElementById('remember-me');
    if (rememberMeCheckbox.checked) {
        // Se estiver marcada, define o cookie com os dados de login
        setRememberMeCookie(usuario, senha);
    } else {
        // Se não estiver marcada, remove qualquer cookie existente com os dados de login
        document.cookie = 'loginData=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
    }
});