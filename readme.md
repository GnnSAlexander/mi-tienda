# Mi Tienda - Prueba técnica

## Instalación

1. Clonar el repositorio.
    ```
    git clone git@github.com:GnnSAlexander/mi-tienda.git
    ```
2. Crear el archivo .env usando el file .env.example, modificar la configuración necesaria para establecer una conexión con la base de datos y agregar las credenciales de Place To Pay
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret
    
    PLACETOPAY_URL=url_to_production
    PLACETOPAY_URL_TEST=url_to_test
    PLACETOPAY_LOGIN=login
    PLACETOPAY_TRANKEY=trankey
    ```
3. Descargar todas las dependencias ejecutando
    ```
    composer install
    ```
4. Ejecutar las migraciones con el siguiente comando
    ```
    php artisan migrate
    # si quieres cargar algunos datos de prueba
    php artisan db:seed
    ```
5. y listo.
    * Si estas usando [Valet](https://laravel.com/docs/5.5/valet, "Valet") solo es entrar a la url [http://mi-tienda.test](http://mi-tienda.test)
     * O puede ejecutar el siguiente comando
        ```
          php artisan server
        ```
        y entrar a esta url [http://localhost:8000](http://localhost:8000)


#URLS

| Method | URL | Descripción | Parámetros |
| ------ | ---- | --------| ---- |
| GET  | /  |  Página de inicio | |
| GET  | /checkout/{**id**?} | Información de facturación | **id**: id de la order
| POST  | /checkout | Creación de orden |
| GET  | /checkout/summary/{**order**} | Resumen de la orden | **order**: id de la order
| GET  | /checkout/summary/response/{**order**} | Url de retorno | order: id de la order
| GET  | /my-orders | Lista las órdenes por usuario |
| GET  | /my-orders/{**order**} | Detalle de la orden | **order**: id de la order
| POST  | /search | Metodo para recuperar las órdenes  |
| GET  | /admin/orders?**code** | Página de administración  | **code**: código de acceso por default 1234


#Tarea programada
Registrada con el comando ```update:orders```, como ejecutarlo
* Si estas en local puedes ejecutar ```php artisan schedule:run```
* Si estas en servidor puedes ejecutar ```* * * * * php /RUTA_DEL_PROYECTO/artisan schedule:run >> /dev/null 2>&1```

##TESTS
* Crear la base de datos en phpunit.xml ```<env name="DB_DATABASE" value="test_test"/>```
    ```
    ./vendor/bin/phpunit
    ```

#Nota
Ejecutar este comando ```php artisan key:generate``` por si te sale este error ```No application encryption key has been specified.```