# MaquinariaVial

Sistema de Gestión de Maquinaria Vial
Este es un proyecto desarrollado como parte de la currícula académica, diseñado para gestionar el inventario, las asignaciones y el mantenimiento de maquinaria pesada en una empresa de construcción vial.


📝 Descripción del Proyecto
El objetivo de este sistema es permitir a una empresa constructora:

Rastrear la ubicación y el estado de cada una de sus máquinas. 
Gestionar las asignaciones de máquinas a diferentes obras, con un control estricto de fechas y kilometraje. 
Generar historiales de uso para análisis de productividad y para programar mantenimientos preventivos. 


🛠️ Requisitos Previos
Para ejecutar este proyecto, necesitarás tener instalado el siguiente software en tu sistema:

PHP (versión 8.2 o superior)
Composer (para gestionar las dependencias de PHP)
Node.js y npm (para gestionar las dependencias de frontend)
Un servidor de base de datos (el proyecto está configurado para MySQL)
Git (para clonar el repositorio)
Entorno de Desarrollo Recomendado: Laravel Herd
Este proyecto fue desarrollado utilizando Laravel Herd. Herd es un entorno de desarrollo para macOS y Windows que incluye todo lo necesario (PHP, Nginx, Node.js) en una sola aplicación fácil de usar, haciendo la configuración muy sencilla. Si usas Herd, muchos de los pasos de configuración del servidor web y base de datos se manejan automáticamente.



🚀 Guía de Instalación
Sigue estos pasos para poner en funcionamiento el proyecto en tu máquina local.

1. Clonar el Repositorio
Abre tu terminal y clona el repositorio del proyecto:
git clone <URL_DE_TU_REPOSITORIO>
cd <nombre-de-la-carpeta-del-proyecto>

2. Instalar Dependencias
Instala las dependencias de PHP (Laravel y otros paquetes) y de JavaScript (Vite, Alpine.js, etc.).
composer install
npm install

3. Configurar el Archivo de Entorno (.env)
Este archivo contiene las configuraciones específicas de tu entorno (base de datos, credenciales de correo, etc.).
Copia el archivo de ejemplo:
cp .env.example .env

Abre el archivo .env en tu editor de código y configura las siguientes secciones:
a) Base de Datos:
Asegúrate de que las credenciales coincidan con tu configuración de base de datos local. Si usas Herd, él puede crear una base de datos por ti.
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=maquinaria_vial  # O el nombre que elijas para tu base de datos
DB_USERNAME=root             # Tu usuario de MySQL
DB_PASSWORD=                 # Tu contraseña de MySQL (puede estar vacía por defecto)


4. Ejecutar Migraciones y Seeders
Este es un paso crucial. Creará todas las tablas de la base de datos y las poblará con datos iniciales de prueba (tipos de máquina, marcas, servicios, etc.).
php artisan migrate:fresh --seed
migrate:fresh: Elimina todas las tablas existentes y las vuelve a crear desde cero según los archivos de migración.
--seed: Ejecuta los "seeders" para llenar las tablas con datos de ejemplo.

5. Servir la Aplicación
Si usas Laravel Herd: Herd detectará tu proyecto y lo servirá automáticamente. Podrás acceder a él desde una URL como http://<nombre-de-la-carpeta>.test.
Si NO usas Herd: Abre otra terminal y ejecuta el servidor de desarrollo de Artisan:
php artisan serve
Podrás acceder a la aplicación en http://127.0.0.1:8000.

⚙️ Funcionamiento del Programa
Una vez que la aplicación esté corriendo, podrás probar las siguientes funcionalidades:
Registro y Login:
Navega a /register para crear una nueva cuenta de usuario.
Una vez registrado, podrás iniciar sesión desde /login.

Panel de Control (Dashboard)
Al iniciar sesión, el usuario accede a un Panel de Control Principal. Este actúa como un centro de mando visual desde donde se puede navegar a las tres secciones fundamentales del sistema mediante tarjetas interactivas:
Gestionar Máquinas: Accede al inventario completo de maquinaria.
Gestionar Obras: Administra todos los proyectos de construcción.
Gestionar Asignaciones: Controla la vinculación entre máquinas y obras.
Adicionalmente, desde la barra de navegación superior, se puede acceder a los catálogos de Tipos de Máquina y Servicios.

Gestión de Recursos (CRUDs)
El sistema ofrece una gestión completa (Crear, Leer, Actualizar y Eliminar) para cada uno de sus recursos principales:
Máquinas: Permite gestionar el inventario completo. Una característica clave es que el estado de una máquina (Disponible, Asignada, En Mantenimiento) no se almacena como un campo fijo, sino que se deduce automáticamente basado en sus asignaciones y registros de mantenimiento activos. 

Obras: Permite administrar los proyectos. El estado de una obra (Próxima, En Curso, Finalizada) también se deduce dinámicamente a partir de sus fechas de inicio y fin.

Asignaciones: Es el módulo central que conecta máquinas y obras. Permite crear y editar los detalles de una asignación, así como ejecutar la acción específica de "Finalizar", que desencadena procesos automáticos.

Catálogos: Se pueden gestionar los catálogos de Tipos de Máquina, y Servicios de Mantenimiento, los cuales se utilizan en los formularios de los otros módulos.

Flujo de Trabajo Principal: Asignación y Mantenimiento
Este es el flujo central de la aplicación y demuestra la lógica de negocio implementada.

1. Crear una Nueva Asignación
El formulario de creación de asignaciones es inteligente:
En el desplegable de "Máquinas", solo aparecen las que están disponibles (es decir, no están "Asignadas" ni "En Mantenimiento").
En el desplegable de "Obras", solo aparecen las que no han finalizado (su fecha de fin es nula o futura).
Al crear una asignación, se establece una start_date. La end_date y los kilometers se dejan en NULL, ya que la tarea recién comienza.
Automáticamente, el estado de la máquina seleccionada cambia a "Asignada" en todo el sistema.

2. Finalizar una Asignación
Para cualquier asignación activa, existe la acción "Finalizar".
Al ejecutar esta acción, el sistema solicita obligatoriamente al usuario que ingrese la fecha de fin, los kilómetros recorridos durante esa asignación y un motivo de fin.
Una vez que se guardan estos datos, la asignación se considera completada. Este es el disparador (trigger) para la lógica de mantenimiento automatizada.

3. Lógica Automática Post-Finalización (Eventos y Listeners)
Cuando una asignación es finalizada, ocurre lo siguiente en segundo plano gracias al patrón de Eventos y Listeners de Laravel:
Actualización de Kilometraje:
Se dispara un evento AssignmentFinalized.
Un listener (UpdateMachineKilometers) captura este evento.
Los kilómetros ingresados al finalizar la asignación se suman al kilometraje total acumulado de la máquina.
Verificación de Mantenimiento:
Inmediatamente después de actualizar el total, el mismo listener revisa el nuevo kilometraje de la máquina y lo compara con los intervalos de todos los servicios definidos en el "Catálogo de Servicios" (ej. "Cambio de Aceite cada 10,000 km").
Programación Automática del Mantenimiento:
Si el kilometraje de la máquina alcanza o supera el umbral para un servicio Y no hay ya un mantenimiento activo o programado para ese mismo servicio, el sistema automáticamente:
Crea un nuevo registro en el historial de service_machines.
Establece una start_date con la fecha actual.
Establece una end_date calculada a 5 días en el futuro, bloqueando la máquina para asignaciones durante ese período.

4. Cambio de Estado Deducido
Como resultado de la creación del registro de mantenimiento, el estado de la máquina cambia automáticamente a "En Mantenimiento" en todo el sistema.
Una vez que la fecha actual supera la end_date del registro de mantenimiento, la máquina volverá a aparecer como "Disponible" (asumiendo que no tiene otras asignaciones activas u otros mantenimientos).

Este flujo asegura que el estado de la maquinaria y sus necesidades de mantenimiento se actualicen de forma automática y consistente basándose en el uso real registrado, cumpliendo con los objetivos del proyecto.
