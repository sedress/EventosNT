<?php
include 'conexion.php';

// Obtener la categoría seleccionada de la URL
$categoria_seleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : null;

// Número de eventos por página
$eventos_por_pagina = 15;

// Obtener la página actual de la URL (por defecto es la página 1)
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Calcular el desplazamiento
$offset = ($pagina_actual - 1) * $eventos_por_pagina;

// Consulta SQL para obtener los eventos con límite y desplazamiento
if ($categoria_seleccionada) {
    $sql = "SELECT Evento.EventoID, Evento.Titulo, Evento.Descripcion, Evento.Lugar, Evento.Hora, Evento.Fecha, Evento.Imagen 
            FROM Evento 
            INNER JOIN Categoria ON Evento.CategoriaID = Categoria.CategoriaID 
            WHERE Categoria.Nombre = '$categoria_seleccionada' 
            LIMIT $offset, $eventos_por_pagina";
} else {
    $sql = "SELECT EventoID, Titulo, Descripcion, Lugar, Hora, Fecha, Imagen 
            FROM Evento 
            LIMIT $offset, $eventos_por_pagina";
}

$result = $conn->query($sql);

// Consulta SQL para contar el total de eventos (con o sin categoría)
if ($categoria_seleccionada) {
    $sql_total = "SELECT COUNT(*) as total 
        FROM Evento 
        INNER JOIN Categoria ON Evento.CategoriaID = Categoria.CategoriaID 
        WHERE Categoria.Nombre = '$categoria_seleccionada'";
} else {
    $sql_total = "SELECT COUNT(*) as total FROM Evento";
}

$total_result = $conn->query($sql_total);
$total_eventos = $total_result->fetch_assoc()['total'];

// Calcular el número total de páginas
$total_paginas = ceil($total_eventos / $eventos_por_pagina);

// Consulta SQL para obtener todas las categorías
$sql_categorias = "SELECT Nombre FROM Categoria";
$categorias_result = $conn->query($sql_categorias);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Locales</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <!-- Header -->
    <header class="header">
        <a href="eventos.php">
            <img src="Logo.png" alt="Logo" class="logoHeader">
        </a>
        <button class="nav-toggle" onclick="toggleMenu()">☰</button>
        <div class="nav-links" id="navLinks">
            <a href="/EVENTOSNT/pages/addevents/administrar_eventos.php">Administrar eventos</a>
            <a href="#">Perfil</a>
            <a href="/EVENTOSNT/index.html">Cerrar Sesión</a>
        </div>
    </header>

    <!-- Contenido principal -->
    <div class="Contenido-principal">
        <main>
            <section class="sección-principal">
                <h1 class="H1-Titulo-Eventos">Eventos</h1>
                <div class="tarjetas-contenedor">
                    <?php
                    if ($result->num_rows > 0) {
                        // Mostrar los datos de cada evento en forma de tarjeta
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="tarjeta">';
                            echo '<img src="' . $row['Imagen'] . '" alt="' . $row['Titulo'] . '">';
                            echo '<div class="contenido">';
                            echo '<h5>' . $row['Titulo'] . '</h5>';
                            echo '<p>' . $row['Descripcion'] . '</p>';
                            echo '</div>';
                            echo '<div class="inferior">';
                            echo '<small>' . $row['Lugar'] . ' - ' . $row['Fecha'] . ' a las ' . $row['Hora'] . '</small>';
                            echo '</div>';
                            echo '<button class="boton-asistir" onclick="toggleAsistencia(this)">Asistir</button>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No hay eventos disponibles</p>';
                    }
                    ?>
                </div>

                <!-- Paginación -->
                <div class="paginacion">
                    <?php
                    if ($pagina_actual > 1) {
                        echo '<a href="eventos.php?pagina=' . ($pagina_actual - 1) . '&categoria=' . $categoria_seleccionada . '" class="boton-paginacion">&laquo; Anterior</a>';
                    }

                    if ($pagina_actual < $total_paginas) {
                        echo '<a href="eventos.php?pagina=' . ($pagina_actual + 1) . '&categoria=' . $categoria_seleccionada . '" class="boton-paginacion">Siguiente &raquo;</a>';
                    }
                    ?>
                </div>
            </section>
        </main>

        <aside>
            <h2 class="titulo-aside">Categorías</h2>
            <div class="categorias">
                <!-- Botón para mostrar todos los eventos sin filtro -->
                <button onclick="filtrarCategoria(null)">Mostrar Todos</button>

                <?php
                if ($categorias_result->num_rows > 0) {
                    // Mostrar las categorías dinámicamente
                    while ($categoria = $categorias_result->fetch_assoc()) {
                        echo '<button onclick="filtrarCategoria(\'' . $categoria['Nombre'] . '\')">' . $categoria['Nombre'] . '</button>';
                    }
                } else {
                    echo '<p>No hay categorías disponibles</p>';
                }
                ?>
            </div>
        </aside>
    </div>
    <!-- Footer -->
    <footer>
        <div>
            <p><a href="/src/reportBug/ReportBugg.html">Reportar un problema</a></p>
            <p>&copy; 2024 Eventos Locales. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script>
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('show');
        }

        function toggleAsistencia(button) {
            if (button.innerText === "Asistir") {
                button.innerText = "Asistiré";
            } else {
                button.innerText = "Asistir";
            }
        }


        function filtrarCategoria(categoria) {
            if (categoria) {
                window.location.href = `eventos.php?categoria=${categoria}`;
            } else {
                window.location.href = `eventos.php`; // Redirige a la página sin filtro
            }
        }
    </script>
</body>

</html>

<?php
$conn->close();
?>