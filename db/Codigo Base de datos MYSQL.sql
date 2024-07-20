-- Crear la base de datos
CREATE DATABASE EventosNT1;

-- Seleccionar la base de datos
USE EventosNT1;

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