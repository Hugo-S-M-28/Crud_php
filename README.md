# CRUD con PHP

Este proyecto fue desarrollado como parte de las clases de desarrollo web en la **Universidad Veracruzana (UV)**. El objetivo del proyecto es implementar un sistema **CRUD** (Crear, Leer, Actualizar, Eliminar) utilizando **PHP** para la lógica de negocio y **MySQL** para la base de datos.

## Descripción

El proyecto permite gestionar información de empleados, proporcionando una interfaz web para **agregar**, **editar**, **eliminar** y **visualizar** registros de manera eficiente. Es una implementación básica de las operaciones CRUD, diseñada para aprender y practicar el uso de PHP y MySQL en el desarrollo de aplicaciones web.

### Funcionalidades:

- **Registrar Empleado**: Agrega un nuevo empleado con su nombre, apellido y fecha de registro.
- **Modificar Empleado**: Permite editar los datos de un empleado previamente registrado.
- **Eliminar Empleado**: Permite eliminar un empleado registrado en la base de datos.
- **Visualizar Empleados**: Muestra una lista de todos los empleados actualmente registrados.

## Estructura de la Base de Datos

La base de datos utilizada en este proyecto es **MySQL**, y contiene una tabla llamada `empleado` con la siguiente estructura:

### Tabla: `empleado`

| Campo         | Tipo de Dato  | Descripción                             |
|---------------|---------------|-----------------------------------------|
| `idempleado`  | INT           | Identificador único del empleado        |
| `nombre`      | VARCHAR(100)  | Nombre del empleado                     |
| `apellido`    | VARCHAR(100)  | Apellido del empleado                   |
| `fecharegistro`| DATE          | Fecha de registro del empleado          |

### SQL Dump para la base de datos:

```sql
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
-- ------------------------------------------------------
-- Host: localhost    Database: crudphp
-- Server version    8.0.39

CREATE TABLE `empleado` (
  `idempleado` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecharegistro` date NOT NULL,
  PRIMARY KEY (`idempleado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `empleado` VALUES
(1,'Gerardo','Pérez','2020-01-28'),
(2,'Ana','García','2023-02-20'),
(3,'Luis','Martínez','2023-03-10'),
(4,'María','López','2023-04-25'),
(5,'Samuel','Sánchez','2020-04-26');
```

## Estructura del Proyecto

La estructura de carpetas y archivos del proyecto es la siguiente:

```
crud_php/
│
├── controlador/
│   ├── Eliminar_empleado.php
│   ├── Modificar_empleado.php
│   ├── Registro_empleado.php
│
├── modelo/
│   ├── Conexion.php
│   ├── Empleado.php
│
├── vista/
│   ├── Index.php
│   ├── Modificar_empleado.php
│   ├── Registro_empleado.php
│
└── README.md
```

## Requisitos

Para ejecutar este proyecto en tu máquina local, asegúrate de tener lo siguiente:

- **PHP**: Asegúrate de tener PHP instalado en tu servidor local o servidor web.
- **MySQL**: La base de datos debe ejecutarse con MySQL versión 8.0 o superior.
- **Servidor Local**: Puedes utilizar herramientas como [XAMPP](https://www.apachefriends.org/), [WAMP](https://www.wampserver.com/), o [MAMP](https://www.mamp.info/en/) para montar un servidor local y probar el proyecto.

## Instalación

Sigue estos pasos para instalar y ejecutar el proyecto en tu máquina local:

1. **Clona o descarga el repositorio**:
   ```bash
   git clone https://github.com/tu_usuario/crud_php.git
   ```
   
2. **Configura la base de datos**:
   - Crea una base de datos en MySQL llamada `crudphp`.
   - Ejecuta el SQL dump proporcionado para crear la tabla `empleado` y cargar algunos datos iniciales.

3. **Configura la conexión a la base de datos**:
   - Abre el archivo `modelo/Conexion.php` y configura los parámetros de conexión con los datos de tu servidor MySQL (host, usuario, contraseña).

4. **Accede al proyecto**:
   - Coloca el proyecto en el directorio raíz de tu servidor web local (por ejemplo, en `htdocs` si usas XAMPP).
   - Accede a través de tu navegador a `http://localhost/crud_php/vista/Index.php`.

## Uso

- **Registrar Empleado**: Completa el formulario con el nombre, apellido y fecha de registro del empleado, luego haz clic en "Guardar" para agregarlo a la base de datos.
- **Modificar Empleado**: En la lista de empleados, selecciona un empleado para modificar sus datos. Los cambios se guardarán en la base de datos.
- **Eliminar Empleado**: En la lista de empleados, puedes eliminar un empleado. Este se eliminará de manera permanente de la base de datos.

## Contribuciones y Contacto

Si deseas contribuir al proyecto, puedes realizar un fork del repositorio, implementar nuevas funcionalidades o corregir errores. Asegúrate de enviar un pull request con una descripción clara de los cambios realizados.

### Contacto:

- **LinkedIn**: [Hugo Sánchez Milán](https://www.linkedin.com/in/hugo-s%C3%A1nchez-mil%C3%A1n-197b81278/)
- **GitHub**: [Hugo-S-M-28](https://github.com/Hugo-S-M-28)

---

### ¡Gracias por explorar el proyecto! Espero que disfrutes revisando el trabajo y aprendiendo sobre su implementación.
