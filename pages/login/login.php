<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Iniciar sesión si ya hay datos enviados por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prevenir inyección SQL
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Consulta para verificar el usuario
    $sql = "SELECT * FROM Usuario WHERE CorreoElectronico = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $user['Contrasena'])) {
            // Iniciar sesión y redirigir a la página principal
            session_start();
            $_SESSION['UsuarioID'] = $user['UsuarioID'];
            $_SESSION['Nombres'] = $user['Nombres'];
            header("Location: /EVENTOSNT/pages/main/eventos.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "No existe una cuenta con este correo.";
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <section class="seccion-principal">
        <img src="/EVENTOSNT/public/logo/logo.png" alt="Logo" class="logo">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        } ?>
        <form action="login.php" method="POST">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br>
            <section class="botones">
                <button type="submit">Ingresar</button>
                <a href="/EVENTOSNT/pages/register/register.php"><button type="button" class="buttonR">Registrar</button></a>
            </section>
        </form>
    </section>
</body>

</html>