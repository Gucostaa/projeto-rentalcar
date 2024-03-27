// script.js

// Limpar o cache quando a página é carregada
window.addEventListener('load', function() {
    clearCache(); // Chama a função para limpar o cache
});

// Função para limpar o cache
function clearCache() {
    // Limpa o cache do navegador
    if (caches && caches.keys) {
        caches.keys().then(function(names) {
            for (let name of names) {
                caches.delete(name);
            }
            console.log("Cache limpo com sucesso!");
        });
    } else {
        console.log("Seu navegador não suporta limpeza de cache automaticamente.");
    }
}