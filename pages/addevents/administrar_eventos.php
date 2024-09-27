<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Eventos</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <!-- Header -->
    <header class="header">
        <a href="/EVENTOSNT/pages/main/eventos.php">
            <img src="/EVENTOSNT/public/logo/logo.png" alt="Logo" class="logoHeader">
        </a>
        <button class="nav-toggle" onclick="toggleMenu()">☰</button>
        <div class="nav-links" id="navLinks">
            <a href="/EVENTOSNT/pages/addevents/administrar_eventos.php">Administrar eventos</a>
            <a href="#">Perfil</a>
            <a href="#">Cerrar Sesión</a>
        </div>
    </header>

    <section class="eventos-opc">
        <main class="Adm-eventos">
            <h1>Administrar Eventos</h1>

            <!-- Formulario para Agregar Evento -->
            <h2>Agregar Evento</h2>
            <form action="administrar_eventos.php" method="POST">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" required>

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="descripcion" required></textarea>

                <label for="lugar">Lugar:</label>
                <input type="text" name="lugar" id="lugar" required>

                <label for="hora">Hora:</label>
                <input type="time" name="hora" id="hora" required>

                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="fecha" required>

                <label for="categoria">Categoría:</label>
                <select name="categoria" id="categoria" required>
                    <?php
                    // Obtener las categorías de la base de datos
                    $sql = "SELECT CategoriaID, Nombre FROM Categoria";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['CategoriaID'] . '">' . $row['Nombre'] . '</option>';
                        }
                    } else {
                        echo '<option value="">No hay categorías disponibles</option>';
                    }
                    ?>
                </select>

                <label for="imagen">Imagen (URL):</label>
                <input type="text" name="imagen" id="imagen" required>

                <button type="submit" name="accion" value="agregar">Agregar Evento</button>
            </form>
        </main>

        <!-- Formulario para Actualizar Evento -->
        <section class="Adm-eventos">
            <h2>Actualizar Evento</h2>
            <form action="administrar_eventos.php" method="POST">
                <label for="evento_id">ID del Evento:</label>
                <input type="text" name="evento_id" id="evento_id" required>

                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" required>

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="descripcion" required></textarea>

                <label for="lugar">Lugar:</label>
                <input type="text" name="lugar" id="lugar" required>

                <label for="hora">Hora:</label>
                <input type="time" name="hora" id="hora" required>

                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="fecha" required>

                <label for="categoria">Categoría:</label>
                <select name="categoria" id="categoria" required>
                    <?php
                    // Obtener las categorías de la base de datos
                    $sql = "SELECT CategoriaID, Nombre FROM Categoria";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['CategoriaID'] . '">' . $row['Nombre'] . '</option>';
                        }
                    } else {
                        echo '<option value="">No hay categorías disponibles</option>';
                    }
                    ?>
                </select>

                <label for="imagen">Imagen (URL):</label>
                <input type="text" name="imagen" id="imagen" required>

                <button type="submit" name="accion" value="actualizar">Actualizar Evento</button>
            </form>
        </section>

        <!-- Formulario para Eliminar Eventos -->
        <aside class="delete-events">
            <h2>Eliminar Evento</h2>
            <form action="administrar_eventos.php" method="POST">
                <label for="evento_id_eliminar">ID del Evento a Eliminar:</label>
                <input type="text" name="evento_id_eliminar" id="evento_id_eliminar" required>
                <button type="submit" name="accion" value="eliminar">Eliminar Evento</button>
            </form>
        </aside>
    </section>

    <section class="tabla-eventos">
        <h2>Lista de Eventos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Lugar</th>
                    <th>Hora</th>
                    <th>Fecha</th>
                    <th>Categoría</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Obtener los eventos de la base de datos
                $sql = "SELECT e.EventoID, e.Titulo, e.Descripcion, e.Lugar, e.Hora, e.Fecha, c.Nombre AS Categoria, e.Imagen 
                    FROM Evento e
                    JOIN Categoria c ON e.CategoriaID = c.CategoriaID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['EventoID'] . '</td>';
                        echo '<td>' . $row['Titulo'] . '</td>';
                        echo '<td>' . $row['Descripcion'] . '</td>';
                        echo '<td>' . $row['Lugar'] . '</td>';
                        echo '<td>' . $row['Hora'] . '</td>';
                        echo '<td>' . $row['Fecha'] . '</td>';
                        echo '<td>' . $row['Categoria'] . '</td>';
                        echo '<td><img src="' . $row['Imagen'] . '" alt="Imagen del Evento" style="max-width:100px;"></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="8">No hay eventos disponibles</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </section>


    <a href="/EVENTOSNT/pages/main/eventos.php" class="a-end">Volver a la lista de eventos</a>

    <!-- Footer -->
    <footer>
        <div>
            <p><a href="/src/reportBug/ReportBugg.html">Reportar un problema</a></p>
            <p>&copy; 2024 Eventos Locales. Todos los derechos reservados.</p>
        </div>
    </footer>

    <?php
    // Procesar el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $accion = $_POST['accion'];

        if ($accion == 'agregar') {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $lugar = $_POST['lugar'];
            $hora = $_POST['hora'];
            $fecha = $_POST['fecha'];
            $categoria_id = $_POST['categoria'];
            $imagen = $_POST['imagen'];

            $sql = "INSERT INTO Evento (Titulo, Descripcion, Lugar, Hora, Fecha, CategoriaID, Imagen)
                    VALUES ('$titulo', '$descripcion', '$lugar', '$hora', '$fecha', '$categoria_id', '$imagen')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Nuevo evento agregado exitosamente</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        if ($accion == 'actualizar') {
            $evento_id = $_POST['evento_id'];
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $lugar = $_POST['lugar'];
            $hora = $_POST['hora'];
            $fecha = $_POST['fecha'];
            $categoria_id = $_POST['categoria'];
            $imagen = $_POST['imagen'];

            $sql = "UPDATE Evento 
                    SET Titulo='$titulo', Descripcion='$descripcion', Lugar='$lugar', Hora='$hora', Fecha='$fecha', CategoriaID='$categoria_id', Imagen='$imagen'
                    WHERE EventoID=$evento_id";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Evento actualizado exitosamente</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        if ($accion == 'eliminar') {
            $evento_id_eliminar = $_POST['evento_id_eliminar'];

            $sql = "DELETE FROM Evento WHERE EventoID=$evento_id_eliminar";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Evento eliminado exitosamente</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }
    }

    // Cerrar la conexión
    $conn->close();
    ?>
</body>

</html>