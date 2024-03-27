
document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll('.selectable-button');
    
    buttons.forEach(button => {
      button.addEventListener('click', function() {
        buttons.forEach(btn => btn.classList.remove('selected')); // Remove a classe 'selected' de todos os botões
        this.classList.add('selected'); // Adiciona a classe 'selected' apenas ao botão clicado
      });
    });
  });
