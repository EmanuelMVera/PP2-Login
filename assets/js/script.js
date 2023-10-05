// Función para mostrar u ocultar la contraseña
function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    const passwordToggle = document.getElementById("password-toggle");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordToggle.textContent = "Ocultar contraseña";
    } else {
        passwordInput.type = "password";
        passwordToggle.textContent = "Mostrar contraseña";
    }
}

// Agregar un evento click al botón de alternar contraseña
document.getElementById("password-toggle-button").addEventListener("click", function() {
    togglePasswordVisibility();
});
