// Este script pode ser útil para pré-visualizar a imagem antes de carregar
document.getElementById('profile-image').addEventListener('change', function (e) {
    var reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById('popup-img').src = e.target.result;
    };
    reader.readAsDataURL(this.files[0]);
});