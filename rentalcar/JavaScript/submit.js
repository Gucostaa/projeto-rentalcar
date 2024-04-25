document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("btn").addEventListener("click", function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário
        var formData = new FormData(document.getElementById("loginForm"));

        fetch('submit.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.href = 'logged.php';
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao enviar requisição:', error);
        });
    });
});
