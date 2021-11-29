# API To Do 📝 - Yaiza

Para este primer proyecto en mi formación dual en NODRIZA tech necesitamos crear una API de lista de notas. Esta API permitirá crear notas, marcarlas como completadas
o desmarcarlas y borrar notas.
También permitirá ordenar las tareas por fecha de creación y por orden alfabético. Además se podrá filtrarlas por completadas, pendientes o mostrar todas.
Se puede añadir categorías a las listas y mostrar cada categoría en una vista independiente. 

Se ha implementado una gestión del usuario con inicio de sesión y recuperación de contraseña.


## Construido con 🛠️

Para el desarrollo de esta API se han utilizado las siguientes herramientas: 

* [Symfony 5](https://symfony.com/doc/current/the-fast-track/es/index.html) - El framework que he utilizado ha sido Symfony 5
* [MySQL](https://www.mysql.com/) - Base de Datos MySQL
* [Docker](https://www.docker.com/) - Usado para dockerizar la API.


## Versiones 📌

# Historial de versiones de la API: 

**✅ 1. Versión 1.0 -> En una primera versión, la API es capaz de:**

  - Crear tareas

  - Marcarlas como completadas

  - Desmarcarlas
  

**✅ 2. Versión 2.0 -> En la segunda versión de la API, se añade el filtrado de las tareas.**

  - Ordenarlas por fecha de creación

  - Ordenarlas por orden alfabético

  - Filtrarlas por completadas, pendientes o todas

  - Añadir categorías a las listas

  - Poder mostrar cada categoría en una vista independiente (por medio de filtros)


**✅ 3. Versión 3.0 -> En la tercera versión, se añade la gestión de usuarios y sesiones.**

  - Gestión de usuario

  - Gestión de inicio de sesión con token

  - Persistencia del usuario

  - Gestión de recuperación de contraseña


**✅ 4. Versión 4.0 -> En la cuarta versión, la API se dockeriza.**

  - API dockerizada.

**✅ 5. Versión 5.0 -> En la quinta versión, hemos añadido API Platform y un sistema de
autenticación con JWT (JSON Web Token) de lado del servidor.**

  - Diseño de API REST con estándar OpenAPI y API Platform en la implementación
  - Servicios implementados (getTask, addTask, updateTask, deleteTask + usuarios)

**✅ 6. Versión 6.0 -> EN la sexta versión, hemos añadido un controlador y formulario nuevos que
permiten a los usuarios transferir tareas.**

  - Todos los usuarios pueden realizar una transferencia de sus tareas a otros usuarios.

  - Las tareas terminadas no son transferibles.

  - Para poder transferir una tarea a un usuario, éste no puede tener más de 3 tareas pendientes.

  - Una misma tarea no puede transferirse más de 2 veces.



## Autores ✒️

Este proyecto ha sido desarrollado por: 

* **Yaiza Fernández** - [yaiza-nod](https://github.com/yaiza-nod)

## Notas

Para poder ejecutar la API con la base de datos, se ha incluido el script
de la base de datos en un zip con contraseña. De este modo, solo con la contraseña
del zip se puede acceder a la API con la base de datos con datos ya creados.
