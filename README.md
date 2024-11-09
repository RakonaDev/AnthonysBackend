<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## 🍕 Backend de Pizzeria Anthony's

Este proyecto está hecho con laravel para la gestión de productos y clientes de la pizzería Anthony's. Es una api restful que permite administrar los productos , clientes y pedidos de los clientes.

## 💻 Frontend de Pizzeria Anthony's

- [Frontend de Pizzeria Anthony's](https://github.com/RakonaDev/pizzeriaAnthony)

## 🗒️ Requisitos

- Composer instalado en nuestro equipo [⬇️ Descargar](https://getcomposer.org/download/)
- PHP 8.0.2 o superior [⬇️ Descargar](https://www.php.net/downloads)
- Usar XAMPP o WAMP para desarrollo de base de datos [⬇️ Descargar](https://www.apachefriends.org/es/index.html)

## ✨ Iniciar Proyecto

- Primero Clonaremos el proyecto en nuestro equipo

```bash
git clone https://github.com/RakonaDev/AnthonysBackend.git
```

- Instalamos dependencias

```bash
cd AnthonysBackend
composer install
```

- Copiamos el archivo .env.example a .env 

```bash
cp .env.example .env
```

- Creamos nuestra key de artisan

```bash
php artisan key:generate
```

- Ejecutamos los comandos de migraciones 

```bash
php artisan migrate
```

