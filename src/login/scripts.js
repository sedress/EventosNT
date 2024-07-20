document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe por defecto

    // Aquí puedes implementar la lógica para autenticar al usuario
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;

    // Ejemplo de autenticación básica
    if (username === 'usuario' && password === 'contraseña') {
        // Redirigir a la página de inicio de sesión exitosa
        alert('¡Bienvenido!');
        window.location.href = 'inicio.html';
    } else {
        alert('Usuario o contraseña incorrectos');
    }
});