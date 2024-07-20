// Array de ejemplo de eventos (puedes reemplazarlo con datos reales)
const eventos = [
    { 
        titulo: "Partido de fútbol", 
        lugar: "Estadio", 
        hora: "18:00", 
        fecha: "2024-05-15", 
        categoria: "deportes",
        imagen: "/public/eventos/partidoft.jpeg" // Ruta de la imagen para el primer evento
    },
    { 
        titulo: "Manifestación", 
        lugar: "Plaza Mayor", 
        hora: "12:00", 
        fecha: "2024-06-02", 
        categoria: "informativos",
        imagen: "/public/eventos/manifestacion.jpg" // Ruta de la imagen para el segundo evento
    },
    { 
        titulo: "Concierto en el parque", 
        lugar: "Parque Central", 
        hora: "19:30", 
        fecha: "2024-05-20", 
        categoria: "música",
        imagen: "/public/eventos/concierto.jpg" // Ruta de la imagen para el tercer evento
    },
    { 
        titulo: "Exhibición de arte", 
        lugar: "Galería de Arte Moderno", 
        hora: "17:00", 
        fecha: "2024-05-18", 
        categoria: "cultural",
        imagen: "/public/eventos/exhibicion.jpg" // Ruta de la imagen para el cuarto evento
    },
    { 
        titulo: "Feria de comida", 
        lugar: "Plaza de la Ciudad", 
        hora: "13:00", 
        fecha: "2024-05-25", 
        categoria: "gastronomía",
        imagen: "/public/eventos/feria.jpg" // Ruta de la imagen para el quinto evento
    },
    { 
        titulo: "Seminario de tecnología", 
        lugar: "Centro de Convenciones", 
        hora: "10:00", 
        fecha: "2024-05-28", 
        categoria: "educativo",
        imagen: "/public/eventos/tecnologia.jpg" // Ruta de la imagen para el sexto evento
    },
    { 
        titulo: "Desfile de moda", 
        lugar: "Paseo de la Moda", 
        hora: "16:00", 
        fecha: "2024-06-05", 
        categoria: "moda",
        imagen: "/public/eventos/desfile.jpg" // Ruta de la imagen para el séptimo evento
    },
    { 
        titulo: "Torneo de ajedrez", 
        lugar: "Club de Ajedrez", 
        hora: "14:00", 
        fecha: "2024-05-22", 
        categoria: "deportes",
        imagen: "/public/eventos/ajedrez.jpg" // Ruta de la imagen para el octavo evento
    },
    { 
        titulo: "Presentación literaria", 
        lugar: "Biblioteca Municipal", 
        hora: "18:30", 
        fecha: "2024-06-10", 
        categoria: "cultural",
        imagen: "/public/eventos/literatura.jpg" // Ruta de la imagen para el noveno evento
    },
    { 
        titulo: "Festival de cine", 
        lugar: "Cine Central", 
        hora: "20:00", 
        fecha: "2024-05-30", 
        categoria: "cultural",
        imagen: "/public/eventos/cine.jpg" // Ruta de la imagen para el décimo evento
    }
];


// Función para mostrar eventos en la página
function mostrarEventos() {
    const eventList = document.getElementById("eventList");

    // Limpiar el contenido previo
    eventList.innerHTML = '';

    // Recorrer el array de eventos y agregar cada evento al HTML
    eventos.forEach(evento => {
        const eventHtml = `
            <div class="event-card event" data-categoria="${evento.categoria}">
                <div class="event-image">
                    <img src="/public/eventos/${evento.imagen}" alt="${evento.titulo}">
                </div>
                <div class="event-info">
                    <h2>${evento.titulo}</h2>
                    <p>Lugar: ${evento.lugar}</p>
                    <p>Hora: ${evento.hora}</p>
                    <p>Fecha: ${evento.fecha}</p>
                    <button class="asistire" onclick="agregarEventoAsistire('${evento.titulo}')">Asistiré</button>
                </div>
            </div>
        `;
        eventList.innerHTML += eventHtml;
    });

    // Actualizar el calendario con los nuevos eventos
    actualizarCalendario(eventos);
}

// Función para actualizar el calendario
function actualizarCalendario(eventos) {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: eventos.map(evento => ({
            title: evento.titulo,
            start: evento.fecha
        }))
    });

    calendar.render();
}

// Función para agregar evento a localStorage
function agregarEventoAsistire(titulo) {
    let eventosAsistire = JSON.parse(localStorage.getItem('eventosAsistire')) || [];
    const evento = eventos.find(evento => evento.titulo === titulo);
    if (evento && !eventosAsistire.some(e => e.titulo === titulo)) {
        eventosAsistire.push(evento);
        localStorage.setItem('eventosAsistire', JSON.stringify(eventosAsistire));
        alert(`Te has registrado para asistir a: ${titulo}`);
    } else {
        alert(`Ya estás registrado para asistir a: ${titulo}`);
    }
}

// Función para mostrar eventos a los que asistiré
function mostrarEventosAsistire() {
    const eventList = document.getElementById("eventList");

    // Limpiar el contenido previo
    eventList.innerHTML = '';

    let eventosAsistire = JSON.parse(localStorage.getItem('eventosAsistire')) || [];

    if (eventosAsistire.length === 0) {
        eventList.innerHTML = '<p>No hay eventos a los que asistirás.</p>';
        return;
    }

    eventosAsistire.forEach(evento => {
        const eventHtml = `
            <div class="event-card event" data-categoria="${evento.categoria}">
                <div class="event-image">
                    <img src="/public/eventos/${evento.imagen}" alt="${evento.titulo}">
                </div>
                <div class="event-info">
                    <h2>${evento.titulo}</h2>
                    <p>Lugar: ${evento.lugar}</p>
                    <p>Hora: ${evento.hora}</p>
                    <p>Fecha: ${evento.fecha}</p>
                    <button class="eliminar" onclick="eliminarEventoAsistire('${evento.titulo}')">Eliminar</button>
                </div>
            </div>
        `;
        eventList.innerHTML += eventHtml;
    });
}

// Función para eliminar evento de localStorage
function eliminarEventoAsistire(titulo) {
    let eventosAsistire = JSON.parse(localStorage.getItem('eventosAsistire')) || [];
    eventosAsistire = eventosAsistire.filter(evento => evento.titulo !== titulo);
    localStorage.setItem('eventosAsistire', JSON.stringify(eventosAsistire));
    mostrarEventosAsistire(); // Actualizar la lista después de eliminar
}

// Función que se ejecuta al cargar la página para mostrar todos los eventos
document.addEventListener('DOMContentLoaded', () => {
    mostrarEventos();
});