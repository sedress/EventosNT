# Eventos NT

## Proyecto de Promoción de Eventos Locales

Eventos NT es una plataforma web dedicada a la promoción de eventos locales. Permite a los usuarios visualizar eventos, filtrar por categorías, registrarse, iniciar sesión y generar entradas para asistir a los eventos.

## Descripción
Este proyecto consiste en una página web enfocada en la promoción de eventos culturales y locales. Los usuarios pueden ver una lista de eventos, filtrar por categorías y obtener información detallada de cada evento.

## Integrantes del Grupo
- **Sebastián Andrés Mendoza García**
- **Michell Nicolás Riveros Ramírez**
- **Jesús David Aguilar Daza**

### Ficha
2758313

## Características principales
- Listado de eventos con detalles como fecha, hora, ubicación y descripción.
- Filtrado de eventos por categoría.
- Registro e inicio de sesión de usuarios.
- Generación de entradas digitales para eventos.
- Administración de usuarios, eventos y asistencia.
- Reporte de errores e incidencias en la plataforma.

## Tecnologías utilizadas
- **Backend:** PHP con MySQL
- **Frontend:** HTML, CSS y JavaScript
- **Servidor local:** XAMPP

## Herramientas Utilizadas
- **Git:** Para el control de versiones y seguimiento de los cambios en el código.
- **GitHub:** Para el almacenamiento y la colaboración en el código a través de un repositorio centralizado.
- **Visual Studio Code:** Como entorno de desarrollo integrado (IDE) para escribir, editar y gestionar el código del proyecto.

## Instalación y configuración
1. Clona el repositorio:
   ```bash
   git clone https://github.com/sedress/EventosNT.git
   ```
2. Configura la base de datos en MySQL:
   - Importa el archivo SQL (`eventosnt.sql`) en phpMyAdmin o mediante consola.
3. Configura la conexión a la base de datos en `conexion.php`:
   ```php
   $conexion = new mysqli("localhost", "usuario", "contraseña", "eventosnt");
   ```
4. Inicia el servidor local con XAMPP y asegúrate de que Apache y MySQL estén activos.
5. Accede a la aplicación desde el navegador en `http://localhost/EventosNT/`

## Estructura del proyecto
- `index.php`: Página principal con listado de eventos.
- `login.php` y `register.php`: Vistas para autenticación de usuarios.
- `evento.php`: Detalles de un evento específico.
- `admin/`: Panel de administración de eventos y usuarios.
- `css/`: Estilos de la aplicación.
- `js/`: Scripts de funcionalidad interactiva.

## Futuras mejoras
- Implementación de notificaciones para recordatorios de eventos.
- Integración con pasarelas de pago para compra de entradas.
- Optimización del diseño para mejorar la experiencia del usuario.
