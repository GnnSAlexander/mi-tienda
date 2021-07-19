# Mi Tienda - Prueba tecnica

## Instalación

1. Clonar el repositiorio.
    ```
    git clone git@github.com:GnnSAlexander/mi-tienda.git
    ```
2. Crear el archivo .env usando el file .env.example, modificar la conexion a la base de dato y agregar las credenciales de Place To Pay
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
    * Si esta usando [Valet](https://laravel.com/docs/5.5/valet, "Valet") solo es entrar a la url [http://mi-tienda.test](http://mi-tienda.test)
     * O puede ejecutar el siguiente comando
        ```
          php artisan server
        ```
        y entrar a esta url [http://localhost:8000](http://localhost:8000)

#Nota
Ejecutar este comando ```php artisan key:generate``` por si te sale este error ```No application encryption key has been specified.```