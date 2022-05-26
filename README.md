# Mi Wordle (Ejemplo)
Practica Wordle

## Preparar el entorno

1. Instalar Docker
2. Descargar repo
3. Desde la consola o el power shell, ve a la carpeta donde tienes el proyecto
4. ejecuta docker-compose up -d
5. ejecuta ./init.sh
6. abre la web: http://localhost:8888/listadopalabras.php



## Prepara tu github.

  1. Crea un repositorio privado
  2. Invita a tu compañero de trabajo
  3. invita a los profesores como admins
  4. Crea un proyecto
  5. Define las tareas
  6. Asignalas
  7. Crea tu primer issue
  8. Crea tu rama de desarrollo
  9. Crea tu primer commit
  10. Crea tu primer Pull request

## Planifica tu trabajo

1. **semana 1**
  Analisi planificación de tareas y reparto de tareas.
2. **semana 2**
  Diseño:  bbdd diseño listo y pseocodigo de como vamos a resolver los problemas
3. **semana 3**
  Conocer el entorno de trabajo. conexion web con bbdd realizada
4. **semana 4**
  implementación
5. **semana 5** 
  pruebas


## Flujo de trabajo en Scrum


1. Definir tareas y repartirlas por Sprints ( el desarrollo se hará por fases, cada fase es un sprint "entregable). Nosotros vamos a simular un sprint algo largo de 5 semanas. lo habitual son 2-3 semanas. Las tareas tienen 4 fases. Todo, en proceso, en espera, listo

2. Cada tarea, se realiza en una branch independiente. La branch se vinvula a la tarea desde el gestor de proyectos de github. La tarea la realiza un desarrollador que tiene la tarea asignada.

3. Cuando se finaliza la tarea, se realiza un pull request para que el otro compañero lo apruebe y lo fusione con la rama principal.

4. Una tarea, una branch. Las branch se cierran despues de cada pull request. y de cerrar la tarea. 

4. Al finalizar el sprint, se "entrega" una versión. Esa entrega, puede ser subir a la nuve la aplicación o a algun servidor web.

5. Cada semana, tendremos una reunión de seguimiento del proyecto. Una reunión de 10-15 minutos con el scrum Manager del proyecto. Habitualmente, estas reuniones se hacen diarias al inicio de la jornada laboral. En estas reuniones se habla de impedimentos, de bloqueos que nos hayamos encontrado entre los miembros del equipo y el Scrum Manager. No son reuniones para resolver dudas de implementación sino solucionar conflictos en el desarrollo. 



## Requisitos para subir nuestro wordle a la web.


1. Tener una cuenta en Docker Hub. Si no la tengo, me registro.
2. Tener una cuenta en Azure for Students. Buscar en google e indentificaros con la cuenta de teams del centro.
3. Crear una BBDD en Azure. -> mirar el PDF. Hay que crear una bbdd en AZURE para nuestro Wordle, crear un servidor y la bbdd.
    - 3.1. Desde Azure Data Studio, nos conectaremos a esa bbdd y crearemos la bbdd y la rellenaremos ( Sin Bulks ni .baks).
    - 3.2. Seguramente, nos pedirá que autorizemos nuestra IP en el firewall de la BBDD en AZURE. Le diremos que si
    - 3.3 Cambiaremos la conexión de nuestra bbdd a la de azure. Ahora trabajaremos con la bbdd en la nube. Tenemos que cambiar los datos de conexión en la bbdd en todos los ficheros PHP que se conecten a la bbdd.
4. Crear una imagen con docker y publicarla en Docker HUB como privada.
    - 4.1. Crear el fichero Dockerfile en el raíz del proyecto como el que hay en este. Desde VSCode, botón derecho build image... nos pedirá un nombre a la imagen. Se lo ponemos.
    - 4.2. Docker run -p 80:80 nombreimagen para comprobar que la imagen funciona.
    - 4.3. Desde docker HUB crear un nuevo contenedor y ponerlo privado.
    - 4.4. Docker login y os identificais con las credenciales de docker hub.
    - 4.5 Docker tag nombreimagen bernat13/dfssfsdf (el primero es el nombre de la imagen creada en el 4.1, el segundo es el nick de dockerhub y el nombre de la imagen que has creado desde la web.)
    - 4.6 docker push alias/nombreimagen
    - 4.7 La imagen se ha creado en docker hub.
5. Desplegar la imagen en Azure.
    - 5.1 En QuickStarter center, le damos a create new app -> build and host...
    - 5.2 Rellenamos las opciones que nos dá, escoger siempre la opción más barata. y más cercana que os deje con la licencia Azure for students. En publish, le daremos a docker container linux.
    - 5.3 En el apartado de docker, le daremos a single container y docker hub. acceso privado, nuestras credenciales o un acces token que podemos conseguir en docker hub en lugar de poner nuestra clave. y en image and tag, pondremos nuestro alias/nombreimagen. la ultima casilla de startup command, la dejamos en blanco.
    - 5.4. nuestra app ya está en línea. en el punto 5.2 habremos escogido la url. Probadla. Seguramente fallará y os dirá un error de que la ip X.X.X.X no está permitida en el firewall de la bbdd. Buscaremos el firewall en la configuración de la bbdd y añadiremos una nueva regla con esa IP.
6. Nuestra app ya funciona! y está online!