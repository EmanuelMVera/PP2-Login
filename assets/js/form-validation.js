document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");

    loginForm.addEventListener("submit", function (event) {
        if (!validateLoginForm()) {
            event.preventDefault();
        }
    });

    registerForm.addEventListener("submit", function (event) {
        if (!validateRegisterForm()) {
            event.preventDefault();
        }
    });

    function validateLoginForm() {
        const user = document.getElementsByName("user")[0];
        const password = document.getElementsByName("password")[0];
        let valid = true;

        user.classList.remove("error");
        password.classList.remove("error");

        if (user.value.trim() === "") {
            user.classList.add("error");
            valid = false;
        }

        if (password.value.trim() === "") {
            password.classList.add("error");
            valid = false;
        }

        return valid;
    }

    function validateRegisterForm() {
        const usuario = document.getElementsByName("usuario")[0];
        const nombre = document.getElementsByName("nombre")[0];
        const correo = document.getElementsByName("correo")[0];
        const contrasena = document.getElementsByName("contrasena")[0];
        let valid = true;

        usuario.classList.remove("error");
        nombre.classList.remove("error");
        correo.classList.remove("error");
        contrasena.classList.remove("error");

        if (usuario.value.trim() === "") {
            usuario.classList.add("error");
            valid = false;
        }

        if (nombre.value.trim() === "") {
            nombre.classList.add("error");
            valid = false;
        }

        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailRegex.test(correo.value.trim())) {
            correo.classList.add("error");
            valid = false;
        }

        if (contrasena.value.trim() === "") {
            contrasena.classList.add("error");
            valid = false;
        }

        return valid;
    }
});
