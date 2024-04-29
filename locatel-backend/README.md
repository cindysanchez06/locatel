<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Backend
## Descripcion
Este repositorio alberga API REST desarrollado en Laravel 10.10 diseñado para gestionar cuentas de ahorro y transacciones como debitos y creditos.
### Requisitos
- Composer
- PHP >= 8.1
- MySQL

## Instalacion y ejecucion en local
- En el directorio raiz del proyecto (locatel-backend) corre el comando `composer install` para instalar las dependencias.
- Corre el comando `php artisan key:generate` para generar la clave de la aplicacion.
- En tu servidor de base de datos local, crea una base de datos con el nombre `locatel` y luego corre el comando `php artisan migrate` para crear las tablas necesarias.
- Corre el comando `php artisan serve` para arrancar el servidor.

## Endpoints
- **Consulta de Saldo**:
    - [http://host:puerto/api/account/{account_number}](http://host:puerto/api/account/{account_number})
        - Esta URL de la API se utiliza para obtener el saldo de una cuenta de ahorro. Se utiliza por medio del protocolo HTTP, REST con el metodo GET, lleva como parametro el numero de cuenta.
- **Crear Transaccion (Consignar o Retirar)**:
    - [http://host:puerto/api/transaction](http://host:puerto/api/transaction)
        - Esta URL de la API se utiliza para enviar la solicitud de crear una transaccion. Se utiliza por medio del protocolo HTTP, REST con el metodo POST, lleva informacion en el body de el numero de cuenta, el tipo de transaccion (debito o credito) y el monto o valor.
        - Ejemplo de body:
        ```json
        {
            "account_number": "123456789",
            "type": "debit",
            "amount": 10000
        }
        ```
- **Crear Cuenta de ahorros**:
    - [http://host:puerto/api/account](http://host:puerto/api/account)
        - Esta URL de la API se utiliza para enviar la solicitud de crear una cuenta de ahorros. Se utiliza por medio del protocolo HTTP, REST con el metodo POST, lleva informacion en el body de el nombre de usuario y el saldo inicial.
        - Ejemplo de body:
        ```json
        {
            "user_name": "123456789",
            "amount": 100000
        }
        ```
