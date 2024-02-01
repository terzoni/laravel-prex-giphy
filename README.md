### Desafío Backend PHP

- Entorno Docker Laravel v10 y mariadb v10.6
  Archivo .yml [Descargar](https://drive.google.com/file/d/1s-tKvY_mCQI3jrMkOmtrCf6g2bmuWHMt/view?usp=drive_link)
  utilizar el siguiente comando

`$ docker compose up -d`

- Clonar proyecto de github
  Repositorio [Link](https://github.com/terzoni/laravel-prex-giphy.git)

- Compiar archivo 'composer.json' en el directorio 'my-project'

`$ docker exec [NOMBRE CONTENEDOR]-myapp-1 composer update`

- Pegar el resto del proyecto clonado dentro de 'my-project'

- Configurar achivo .env


    GIPHY_API_KEY=9vkkDq57YF0tFZRVsvwldItM6ND6Zhpp

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=backend_v1
	DB_USERNAME=backend_user
	DB_PASSWORD=

- Correr el siguiente comando para crear las tablas y usuarios.

`$ docker exec [NOMBRE CONTENEDOR]-myapp-1 php artisan migrate --seed`

- Ejecuto el siguiente comando

`$ docker exec [NOMBRE CONTENEDOR]-myapp-1 php artisan passport:install`

- Abrir Postman e importar colección de servicios y el Enviroment
  Colección [Descargar](https://drive.google.com/file/d/1PQv7JDY3imT1HMJ9zqQbYcotWe4Vh9uw/view?usp=drive_link)
  Enviroment [Descargar](https://drive.google.com/file/d/1dbw1E_EtVDOX_w69qknmI8Npr9PxY-IJ/view?usp=drive_link)

- El usuario almacenado en la base de datos es 'admin@admin.com' y su pass '123456'

###DER

Imagen:

![](https://i.ibb.co/nMgRv05/DER.png)

###Diagrama de Casos de Usos

Login (El usuario accedería mediante una API Frontend)
![](https://i.ibb.co/svBQB9N/CU-01.png)

Administrar GIFs (El usuario accedería mediante una API Frontend)
![](https://i.ibb.co/PWR71Bx/CU-02.png)

###Diagrama de Secuencia

CU01 - Loguearse en el sistema
![](https://i.ibb.co/cw7nWp5/SEQ-CU-01.png)

CU02 - CU03 - CU04
![](https://i.ibb.co/7nbGSQf/SEQ-CU-020304.png)
