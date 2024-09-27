<?php
// Incluir el archivo de conexión
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tipo_identificacion = $_POST['tipo_identificacion'];
    $numero_identificacion = $_POST['numero_identificacion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    // Prevenir inyección SQL
    $nombres = mysqli_real_escape_string($conn, $nombres);
    $apellidos = mysqli_real_escape_string($conn, $apellidos);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $tipo_identificacion = mysqli_real_escape_string($conn, $tipo_identificacion);
    $numero_identificacion = mysqli_real_escape_string($conn, $numero_identificacion);
    $fecha_nacimiento = mysqli_real_escape_string($conn, $fecha_nacimiento);

    // Verificar si el correo ya está registrado
    $sql_check_email = "SELECT * FROM Usuario WHERE CorreoElectronico = '$email'";
    $result_email = $conn->query($sql_check_email);

    if ($result_email->num_rows > 0) {
        $error = "El correo electrónico ya está registrado.";
    } else {
        // Encriptar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertar nuevo usuario en la base de datos
        $sql_insert = "INSERT INTO Usuario (Nombres, Apellidos, CorreoElectronico, Contrasena, TipoIdentificacion, NumeroIdentificacion, FechaNacimiento)
        VALUES ('$nombres', '$apellidos', '$email', '$hashed_password', '$tipo_identificacion', '$numero_identificacion', '$fecha_nacimiento')";

        if ($conn->query($sql_insert) === TRUE) {
            // Redirigir a la página de inicio de sesión
            header("Location: /EVENTOSNT/pages/login/login.php");
            exit();
        } else {
            $error = "Error al registrar el usuario: " . $conn->error;
        }
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <section class="seccion-principal">
        <h2>Registro de Usuario</h2>
        <?php if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        } ?>
        <form action="register.php" method="POST">
            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" required><br><br>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required><br><br>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="tipo_identificacion">Tipo de Identificación:</label>
            <select id="tipo_identificacion" name="tipo_identificacion" required>
                <option value="DNI">DNI</option>
                <option value="Pasaporte">Pasaporte</option>
                <option value="Otro">Otro</option>
            </select><br><br>

            <label for="numero_identificacion">Número de Identificación:</label>
            <input type="text" id="numero_identificacion" name="numero_identificacion" required><br><br>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br><br>

            <button type="submit">Registrar</button>
        </form>
    </section>
</body>

</html>