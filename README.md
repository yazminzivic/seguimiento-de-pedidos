Pasos para ejecutar correctamente el proyecto

A continuación, se detalla paso a paso cómo configurar el entorno y ejecutar el sistema localmente:

1. Descargar e instalar XAMPP
 -Accedé al siguiente enlace: [https://www.apachefriends.org/es/index.html](https://www.apachefriends.org/es/index.html).
 -Descargá e instalá la versión correspondiente a tu sistema operativo.

2. Preparar la carpeta del proyecto

 -Asegurate de que no haya archivos en la carpeta `C:\xampp\htdocs`. En caso de que los haya, se recomienda vaciarla para evitar conflictos.
 -Descargá el archivo `.zip` del proyecto.
 -Extraé el contenido del `.zip` directamente dentro de la carpeta `C:\xampp\htdocs`.

3. Iniciar servicios necesarios en XAMPP

 -Abrí el panel de control de XAMPP.
 -Iniciá los servicios **Apache** y **MySQL** haciendo clic en el botón **Start** de cada uno.

4. Importar las bases de datos

4.1. Accedé a **phpMyAdmin** desde tu navegador mediante el enlace: [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/).
   Alternativamente, podés hacer clic en el botón **Admin** de la fila de MySQL en el panel de control de XAMPP.

4.2. Crear la base de datos **registro**:

 -Hacé clic en **New** (en el panel izquierdo).
 -Ingresá el nombre `registro` en el campo **Database name**.
 -Hacé clic en **Create**.
 -Una vez creada, ingresá a la base de datos, hacé clic en la pestaña **Import**.
 -Seleccioná el archivo `.sql` correspondiente a la base de datos `registro` y luego hacé clic en **Importar**.

4.3. Repetí el mismo proceso para crear la base de datos **tienda**:

 -Crear una nueva base de datos con el nombre `tienda`.
 -Importá el archivo `.sql` correspondiente a dicha base.

5. Configurar el inicio de sesión con Google
 a. Crear credenciales en Google API Console
 1. Ingresá a [Google API Console](https://console.developers.google.com/).
 2. Creá un nuevo proyecto.
 3. Configurá la **pantalla de consentimiento OAuth**:
   -Seleccioná tipo de usuario: `External`.
   -Agregá los permisos: `email` y `profile`.
 4. En la sección de credenciales:
    Seleccioná "Crear credencial" > OAuth client ID.
    Tipo de aplicación: `Web application`.
    Ingresá el siguiente URI de redirección autorizado:
      http://localhost/DemoCrud4/index.php
    Guardá el Client ID y Client Secret generados.
 5. Reemplazá esos valores en el archivo `config.php` del proyecto:
    `client_id`
    `client_secret`
b. Instalar Composer
  -Descargá e instalá Composer desde: [https://getcomposer.org/download/](https://getcomposer.org/download/)

c. Instalar dependencias del cliente de Google
 1. Copiá los archivos del proyecto a la carpeta `C:\xampp\htdocs\DemoCrud4`.
 2. Abrí una ventana de comandos como administrador y dirigite a la carpeta del proyecto.
 3. Ejecutá el siguiente comando:
 
    ```bash
    composer require google/apiclient:"^2.12.1"
    ```
 
    > Nota: este proceso puede tardar algunos minutos dependiendo de tu conexión.

6. Ejecutar la aplicación

 -Abrí tu navegador y accedé al siguiente enlace: [http://localhost/index.php](http://localhost/index.php)
 -¡Listo! Ya podés comenzar a usar el programa.

