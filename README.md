# Sistema de Gestión de Reservas

Este proyecto es una aplicación web para gestionar reservas en diferentes sedes. Ofrece funcionalidades para registrar reservas, verificar disponibilidad, y consultar un cronograma filtrado por cliente o sede.

## 📝 Funcionalidades

### 1. **Registro de Reservas**
- Selección de sede, fecha, hora de ingreso y número de acompañantes.
- **Validaciones:**
  - Horario de operación.
  - Capacidad máxima de la sede.
  - Reservas cruzadas para evitar conflictos de horario.
- Inserción segura de datos en la base de datos `Reservas`.

### 2. **Visualización del Cronograma**
- **Filtros:**
  - Búsqueda por nombre de cliente.
  - Selección de sede específica.
- **Tabla Dinámica**:
  - Muestra cliente, sede, fecha, hora de ingreso/salida y número de acompañantes.
- **Consulta SQL Segura** usando consultas preparadas para prevenir inyección de SQL.

### 3. **Instrucciones de Instalación y Configuración** 🚀 
- **Clonar el Repositorio**
  - git clone https://github.com/DeybiJunior/Sistema-de-Gesti-n-de-Reservas.git
- **Configurar la Base de Datos**
  - importar sistema de reserva.sql o Copiar y pegar el script sistema de reserva.txt

---

## 📁 Estructura del Proyecto
- **proyecto-reservas**  
  - 📄 **index.php**: Página principal de selección de reserva o ver reserva  
  - 📄 **reserva.php**: Página para realizar una reserva  
  - 📄 **listarreserva.php**: Página para visualizar las reservas realizadas  
  - 📄 **conexion.php**: Archivo de conexión a la base de datos  
  - 📁 **css**  
    - 🎨 **estilotabla.css**: Estilos personalizados para la tabla  
  - 📁 **recursos**  
    - 🖼️ **R.jfif**: Imagen para la página de reserva  
    - 🖼️ **rr.jfif**: Imagen para la página de ver reservas

📋 Validaciones y Restricciones
Validación de Horarios: Las reservas deben estar dentro del horario de operación.
Capacidad Máxima: Se controla que no se exceda la capacidad máxima por sede.
Reservas Cruzadas: Evita que un cliente reserve en horarios que se solapen.
Seguridad SQL: Uso de consultas preparadas para prevenir inyección de SQL.

🌟 Ejemplo de Uso
Registro de Nueva Reserva
Seleccionar sede.
Elegir fecha y hora de ingreso.
Ingresar número de acompañantes.
Pulsar "Registrar Reserva".
Visualización del Cronograma
Aplicar filtros por nombre de cliente o sede.
Consultar las reservas mostradas en la tabla.

🛠️ Tecnologías Utilizadas
PHP 7.4+
MySQL para la base de datos.
Bootstrap 5 para diseño responsivo.

📬 Contribuciones
¡Las contribuciones son bienvenidas! Si tienes ideas o mejoras, no dudes en hacer un pull request o abrir un issue.

Autor: [Deybi Junior Ruiz Marquina]
