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

5. Ejecutar la aplicación

 -Abrí tu navegador y accedé al siguiente enlace: [http://localhost/index.php](http://localhost/index.php)
 -¡Listo! Ya podés comenzar a usar el programa.

