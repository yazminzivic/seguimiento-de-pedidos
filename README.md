# Login-Google
Login Basico Google
Primero debemos generan en Google API Console (gestion de client id y su token)

https://console.developers.google.com/

dentro de Google crear el proyecto . 
configurar el consentimiento de usuario
gestionar el secret client id y token (luego reemplazar el client id y el token en el archivo config.php)

configuracion de consentimiento (user external / permisos user email , user profile) 
crear OAuth client id  - web application -  autorized redirect URI (ej . http://localhost/DemoCrud4/index.php) 

instalar en la computadora local o en el servidor el composer https://getcomposer.org/download/

copiar los archivos del proyecto a la carpeta Democrud4 dentro de HTDOCS 

ejecutar en la carpeta del proyecto en ventana de comandoscomo administrador el siguiente comando

composer require google/apiclient:"^2.12.1"  (puede demorar unos minutos segun la conexion) 

luego ejecutar en el navegador HTTP://LOCALHOST/DEMOCRUD4/index.php
