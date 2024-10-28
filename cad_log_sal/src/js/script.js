// script.js
function mudarForm() {
    console.log("Função mudarForm foi chamada");
    const formLogin = document.getElementById("form-login");
    const formCad = document.getElementById("form-cad");

    formLogin.classList.toggle("hidden");
    formCad.classList.toggle("hidden");
}
