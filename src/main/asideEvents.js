// Función para mostrar eventos en el aside ordenados por fecha
function mostrarEventosEnAside() {
    const asideEventList = document.getElementById('asideEventList');

    // Limpiar el contenido previo
    asideEventList.innerHTML = '';

    // Ordenar eventos por fecha de más reciente a más antigua
    const eventosOrdenados = [...eventos].sort((a, b) => new Date(b.fecha) - new Date(a.fecha));

    // Recorrer el array de eventos ordenados y agregar cada evento al HTML
    eventosOrdenados.forEach(evento => {
        const eventHtml = `
            <div class="aside-event-card event" data-categoria="${evento.categoria}">
                <div class="event-info">
                    <h2>${evento.titulo}</h2>
                    <p>Lugar: ${evento.lugar}</p>
                    <p>Hora: ${evento.hora}</p>
                    <p>Fecha: ${evento.fecha}</p>
                </div>
            </div>
        `;
        asideEventList.innerHTML += eventHtml;
    });
}

// Llamar a la función para mostrar eventos en el aside al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    mostrarEventosEnAside();
});
