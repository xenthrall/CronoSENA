# CronoSENA
### Sistema para la Gestión y Optimización de la Planificación Académica



![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php)
![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?style=for-the-badge&logo=laravel)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
![Docker](https://img.shields.io/badge/Docker-20.10-2496ED?style=for-the-badge&logo=docker)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3-38B2AC?style=for-the-badge&logo=tailwind-css)

---

## 📄 Descripción

**CronoSENA** es una aplicación web diseñada para optimizar y simplificar la **planificación de horarios académicos** en el SENA. El sistema permite gestionar de manera centralizada y eficiente los programas de formación, competencias, instructores y fichas, facilitando la creación de cronogramas coherentes y sin conflictos.

### ✨ Características Principales

* **Gestión Centralizada:** Administra programas de formación y más.
* **Asignación Inteligente:** Facilita la asignación de instructores a las competencias de cada ficha.
* **Entorno de Desarrollo contenerizado:** Utiliza Docker para garantizar un entorno de desarrollo consistente y fácil de replicar.

---

## 🗃️ Modelo de la Base de Datos

<details>
  <summary>Ver el Diagrama Entidad-Relación</summary>
  <img src="docs/cronosenadb_schema.png" alt="Database Schema">
</details>

---

## 🛠️ Requisitos Previos

Para ejecutar este proyecto, necesitarás tener instaladas las siguientes herramientas en tu sistema:

* **[Git](https://git-scm.com/downloads)**: Para clonar el repositorio.
* **[Docker](https://docs.docker.com/get-docker/)**: Para la gestión de los contenedores.
* **[Docker Compose](https://docs.docker.com/compose/install/)**: Para orquestar los servicios de la aplicación.
* **(Opcional en Windows)** **[WSL2](https://learn.microsoft.com/es-es/windows/wsl/install)**: Para un mejor rendimiento de Docker.

> **⚠️ Nota para usuarios de Windows:** Se recomienda clonar el repositorio en una ruta fuera de OneDrive o directorios sincronizados con la nube (ej: `C:\Projects\CronoSENA`) para evitar problemas de permisos de archivos con Docker.

---

## 🚀 Puesta en Marcha

Sigue estos pasos para levantar el entorno de desarrollo local.

### 1. Clonar el Repositorio

Abre tu terminal y ejecuta el siguiente comando:

```bash
git clone [https://github.com/xenthrall/CronoSENA.git](https://github.com/xenthrall/CronoSENA.git)
cd CronoSENA

```

2. Configurar el Entorno
El proyecto utiliza un archivo .env para las variables de entorno. Cópialo a partir del ejemplo:

```bash

# Navega al directorio de la aplicación
cd src

# Copia el archivo de ejemplo
cp .env.example .env

```

Las variables por defecto ya están configuradas para funcionar con docker-compose.yml.

3. Levantar los Contenedores
Desde la raíz del proyecto (/CronoSENA), construye y levanta los servicios con Docker Compose:

```bash

docker compose up -d --build

```

Puedes verificar que los contenedores estén activos con 
```bash
docker compose ps.
```
4. Instalar Dependencias
Ejecuta los siguientes comandos para instalar las dependencias de PHP y Node.js dentro del contenedor de la aplicación:

```bash

# Instalar dependencias de Composer (PHP)
docker compose exec app composer install

# Instalar dependencias de NPM (Node.js)
docker compose exec app npm install

# Compilar los assets con Vite (para desarrollo)
docker compose exec app npm run dev
```

5. Configurar la Aplicación
Finalmente, ejecuta las migraciones y genera la clave de la aplicación Laravel:

```bash

# Generar la clave de la aplicación
docker compose exec app php artisan key:generate

# Ejecutar las migraciones para crear las tablas en la base de datos
docker compose exec app php artisan migrate
```

6. ¡Listo para Usar!
Abre tu navegador y accede a la siguiente URL:

👉 http://localhost:8080


---


⚠️ Aclaración Importante
Este proyecto no es un producto oficial del SENA. Fue desarrollado como proyecto de formación en el programa de Análisis y Desarrollo de Software (ADSO), con el propósito de solventar una necesidad evidenciada en el centro de formación donde realicé mis estudios.