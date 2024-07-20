// Función para limpiar los filtros y mostrar todos los eventos
function mostrarTodosLosEventos() {
    const eventElements = document.querySelectorAll('.event-card');

    eventElements.forEach(eventElement => {
        eventElement.style.display = 'block';
    });
}

// Función para filtrar eventos por categoría
function filtrarEventos(categoria) {
    const eventElements = document.querySelectorAll('.event-card');

    eventElements.forEach(eventElement => {
        const eventCategoria = eventElement.getAttribute('data-categoria');
        if (categoria === 'todos' || eventCategoria === categoria) {
            eventElement.style.display = 'block';
        } else {
            eventElement.style.display = 'none';
        }
    });
}

// Función para buscar eventos por nombre
function buscarEventoPorNombre() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const eventElements = document.querySelectorAll('.event-card');

    eventElements.forEach(eventElement => {
        const eventTitle = eventElement.querySelector('h2').textContent.toLowerCase();
        if (eventTitle.includes(searchInput)) {
            eventElement.style.display = 'block';
        } else {
            eventElement.style.display = 'none';
        }
    });
}

// Event listeners para el filtrado
document.addEventListener('DOMContentLoaded', () => {
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const categoria = e.target.getAttribute('onclick').replace("filtrarEventos('", "").replace("')", "");
            filtrarEventos(categoria);
        });
    });

    const limpiarButton = document.querySelector('.btn.btn-primary');
    limpiarButton.addEventListener('click', (e) => {
        e.preventDefault();
        mostrarTodosLosEventos();
    });
});
