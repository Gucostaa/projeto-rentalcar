    // Função para fechar a página após 10 segundos
    function closePageAfterDelay() {
        var counter = 5; // contador inicial
        var successMessage = document.querySelector('.success-message');

        // Função para atualizar o texto do alerta a cada segundo
        function updateCounter() {
            successMessage.innerText = "Registro bem-sucedido! Voltando em " + counter + " segundos.";
            counter--;

            // Verifica se o contador chegou a 0 e fecha a página
            if (counter < 0) {
                window.close();
            } else {
                // Chama a função novamente após 1 segundo
                setTimeout(updateCounter, 1000);
            }
        }

        // Exibe o alerta e inicia a contagem regressiva
        successMessage.style.display = 'block';
        updateCounter();
    }

    // Chama a função para fechar a página após 10 segundos, apenas se o registro for bem-sucedido
    window.onload = function() {
        var successMessage = document.querySelector('.success-message');
        if (successMessage !== null) {
            closePageAfterDelay(); // Chama a função para fechar a página após 10 segundos
        }
    };
