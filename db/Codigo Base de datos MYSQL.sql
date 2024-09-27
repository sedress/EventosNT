-- Crear la base de datos
CREATE DATABASE EventosNT;

-- Seleccionar la base de datos
USE EventosNT;

-- Crear la tabla Categoria
CREATE TABLE Categoria (
    CategoriaID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL UNIQUE
);

-- Crear la tabla Evento
CREATE TABLE Evento (
    EventoID INT AUTO_INCREMENT PRIMARY KEY,
    Titulo VARCHAR(100) NOT NULL,
    Descripcion TEXT,
    Lugar VARCHAR(100) NOT NULL,
    Hora TIME NOT NULL,
    Fecha DATE NOT NULL,
    CategoriaID INT NOT NULL,
    Imagen VARCHAR(255),
    FOREIGN KEY (CategoriaID) REFERENCES Categoria(CategoriaID)
);

-- Crear la tabla Usuario
CREATE TABLE Usuario (
    UsuarioID INT AUTO_INCREMENT PRIMARY KEY,
    Nombres VARCHAR(50) NOT NULL,
    Apellidos VARCHAR(50) NOT NULL,
    CorreoElectronico VARCHAR(100) NOT NULL UNIQUE,
    Contrasena VARCHAR(100) NOT NULL,
    TipoIdentificacion VARCHAR(50) NOT NULL,
    NumeroIdentificacion VARCHAR(20) NOT NULL UNIQUE,
    FechaNacimiento DATE NOT NULL,
    CreaEventos ENUM('si', 'no') DEFAULT 'no'
);

-- Crear la tabla Comentario
CREATE TABLE Comentario (
    ComentarioID INT AUTO_INCREMENT PRIMARY KEY,
    UsuarioID INT NOT NULL,
    EventoID INT NOT NULL,
    Comentario TEXT NOT NULL,
    Fecha DATE NOT NULL,
    FOREIGN KEY (UsuarioID) REFERENCES Usuario(UsuarioID),
    FOREIGN KEY (EventoID) REFERENCES Evento(EventoID)
);

-- Crear la tabla Asistencia
CREATE TABLE Asistencia (
    AsistenciaID INT AUTO_INCREMENT PRIMARY KEY,
    UsuarioID INT NOT NULL,
    EventoID INT NOT NULL,
    Asistira ENUM('si', 'no') DEFAULT 'no',
    FOREIGN KEY (UsuarioID) REFERENCES Usuario(UsuarioID),
    FOREIGN KEY (EventoID) REFERENCES Evento(EventoID)
);

-- Crear la tabla InformeErrores
CREATE TABLE InformeErrores (
    InformeID INT AUTO_INCREMENT PRIMARY KEY,
    DescripcionCorta VARCHAR(255) NOT NULL,
    UsuarioID INT NOT NULL,
    DescripcionDetallada TEXT,
    FOREIGN KEY (UsuarioID) REFERENCES Usuario(UsuarioID)
);


-- Datos para la tabla

-- Insertar 10 registros en la tabla Categoria
INSERT INTO Categoria (Nombre) VALUES
('Concierto'),
('Conferencia'),
('Deporte'),
('Teatro'),
('Festival'),
('Webinar'),
('Taller'),
('Feria'),
('Exposición'),
('Networking');

-- Insertar 10 registros en la tabla Usuario
INSERT INTO Usuario (Nombres, Apellidos, CorreoElectronico, Contrasena, TipoIdentificacion, NumeroIdentificacion, FechaNacimiento, CreaEventos) VALUES
('Carlos', 'Pérez', 'carlos.perez@gmail.com', 'password1', 'DNI', '12345678A', '1990-05-15', 'si'),
('María', 'González', 'maria.gonzalez@yahoo.com', 'password2', 'DNI', '98765432B', '1985-08-25', 'no'),
('Juan', 'Martínez', 'juan.martinez@hotmail.com', 'password3', 'Pasaporte', 'P123456', '1992-10-12', 'no'),
('Ana', 'López', 'ana.lopez@outlook.com', 'password4', 'DNI', '65432198C', '1995-01-20', 'si'),
('David', 'Fernández', 'david.fernandez@gmail.com', 'password5', 'DNI', '11223344D', '1988-06-30', 'si'),
('Laura', 'Sánchez', 'laura.sanchez@yahoo.com', 'password6', 'DNI', '55667788E', '1997-03-14', 'no'),
('José', 'Ramírez', 'jose.ramirez@gmail.com', 'password7', 'Pasaporte', 'P654321', '1993-11-25', 'si'),
('Paula', 'Mendoza', 'paula.mendoza@hotmail.com', 'password8', 'DNI', '44332211F', '1990-12-05', 'no'),
('Manuel', 'Vega', 'manuel.vega@outlook.com', 'password9', 'DNI', '99887766G', '1991-09-17', 'si'),
('Sofía', 'Castro', 'sofia.castro@gmail.com', 'password10', 'DNI', '77665544H', '1996-07-23', 'no');

-- Insertar 10 registros en la tabla Evento
INSERT INTO Evento (Titulo, Descripcion, Lugar, Hora, Fecha, CategoriaID, Imagen) VALUES
('Concierto de Rock', 'Una noche inolvidable de rock en vivo.', 'Auditorio Nacional', '20:00:00', '2024-10-01', 1, 'https://example.com/rock-concert.jpg'),
('Conferencia de Tecnología', 'Expertos discuten sobre el futuro de la IA.', 'Centro de Convenciones', '10:00:00', '2024-11-15', 2, 'https://example.com/tech-conference.jpg'),
('Partido de Fútbol', 'Gran partido entre los equipos locales.', 'Estadio Municipal', '18:30:00', '2024-09-30', 3, 'https://example.com/soccer-match.jpg'),
('Obra de Teatro Clásica', 'Una representación del clásico Hamlet.', 'Teatro Principal', '19:00:00', '2024-09-28', 4, 'https://example.com/theater-play.jpg'),
('Festival de Música', 'Una semana de música al aire libre.', 'Parque Central', '17:00:00', '2024-10-05', 5, 'https://example.com/music-festival.jpg'),
('Webinar de Marketing', 'Aprende las últimas técnicas de marketing digital.', 'Online', '14:00:00', '2024-11-01', 6, 'https://example.com/marketing-webinar.jpg'),
('Taller de Fotografía', 'Curso intensivo para mejorar tus habilidades fotográficas.', 'Escuela de Arte', '09:00:00', '2024-10-20', 7, 'https://example.com/photo-workshop.jpg'),
('Feria de Empleo', 'Encuentra nuevas oportunidades laborales.', 'Centro de Negocios', '09:30:00', '2024-10-15', 8, 'https://example.com/job-fair.jpg'),
('Exposición de Arte', 'Muestra de arte contemporáneo.', 'Galería de Arte Moderna', '11:00:00', '2024-09-25', 9, 'https://example.com/art-exhibition.jpg'),
('Evento de Networking', 'Conecta con profesionales de la industria.', 'Hotel Plaza', '18:00:00', '2024-11-20', 10, 'https://example.com/networking-event.jpg');

-- Insertar 10 registros en la tabla Comentario
INSERT INTO Comentario (UsuarioID, EventoID, Comentario, Fecha) VALUES
(1, 1, '¡Gran concierto! Me encantó la música en vivo.', '2024-10-02'),
(2, 2, 'La conferencia fue muy interesante y bien organizada.', '2024-11-16'),
(3, 3, 'El partido estuvo emocionante, espero más eventos así.', '2024-10-01'),
(4, 4, 'La obra de teatro fue excelente, ¡qué actores tan talentosos!', '2024-09-29'),
(5, 5, 'El festival fue increíble, mucha música y buen ambiente.', '2024-10-06'),
(6, 6, 'El webinar fue muy informativo, aprendí nuevas estrategias de marketing.', '2024-11-02'),
(7, 7, 'El taller me ayudó a mejorar mis habilidades fotográficas, muy recomendado.', '2024-10-21'),
(8, 8, 'Buena feria, encontré varias oportunidades laborales.', '2024-10-16'),
(9, 9, 'La exposición de arte estuvo increíble, me encantó la variedad de estilos.', '2024-09-26'),
(10, 10, 'El evento de networking fue muy útil para hacer contactos.', '2024-11-21');

-- Insertar 10 registros en la tabla Asistencia
INSERT INTO Asistencia (UsuarioID, EventoID, Asistira) VALUES
(1, 1, 'si'),
(2, 2, 'si'),
(3, 3, 'si'),
(4, 4, 'no'),
(5, 5, 'si'),
(6, 6, 'no'),
(7, 7, 'si'),
(8, 8, 'si'),
(9, 9, 'no'),
(10, 10, 'si');

-- Insertar 10 registros en la tabla InformeErrores
INSERT INTO InformeErrores (DescripcionCorta, UsuarioID, DescripcionDetallada) VALUES
('Error en el registro', 1, 'No puedo registrarme en el evento de música, la página se queda en blanco.'),
('Problema con la contraseña', 2, 'No puedo cambiar mi contraseña, el enlace no funciona.'),
('Error en la carga de imágenes', 3, 'Las imágenes de los eventos no se están mostrando correctamente.'),
('Fallo en la confirmación de asistencia', 4, 'Intenté confirmar mi asistencia pero el botón no responde.'),
('Página lenta', 5, 'El sitio web es muy lento cuando intento navegar por los eventos.'),
('Problema con el formulario', 6, 'El formulario de contacto no está enviando los mensajes correctamente.'),
('Error en la descripción de eventos', 7, 'Algunos eventos tienen descripciones cortadas o incompletas.'),
('Problema de acceso', 8, 'No puedo acceder a mi cuenta, dice que el correo es incorrecto.'),
('Problema con las notificaciones', 9, 'No estoy recibiendo notificaciones de eventos a los que me he registrado.'),
('Error en el carrito de compra', 10, 'No puedo añadir más de un boleto al carrito para un evento.');
