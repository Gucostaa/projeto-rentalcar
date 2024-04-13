// Função para exibir o popup com a mensagem específica
function displayPopup(message) {
    document.getElementById('alertMessage').textContent = message;
    document.getElementById('alert').style.display = 'block';
}

// Função para fechar o popup
function closePopup() {
    document.getElementById('alert').style.display = 'none';
}