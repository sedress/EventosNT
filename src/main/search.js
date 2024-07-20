// Función para buscar eventos por nombre
function buscarEventoPorNombre() {
    // Obtener el texto ingresado en el cuadro de búsqueda
    var searchText = document.getElementById('searchInput').value.trim().toLowerCase();

    // Obtener todos los elementos de eventos
    var eventos = document.querySelectorAll('.event');

    // Iterar sobre cada evento y mostrar solo el evento que coincida con el término de búsqueda
    eventos.forEach(function(evento) {
        var tituloEvento = evento.querySelector('h2').textContent.toLowerCase();
        if (tituloEvento.includes(searchText)) {
            evento.style.display = 'block';
        } else {
            evento.style.display = 'none';
        }
    });
}
