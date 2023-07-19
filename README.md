### Antes de ejecutar la aplicación que necesita

- Instalar Docker

## Para ejecutar la aplicación escribe este comando en la consola:

- docker-compose build && docker-compose up -d

## Importante: el puerto de la aplicación es el 14000 => http://127.0.0.1:14000

### Ejecute la APIS

- Para facilitar la ejecución de los endpoints de este proyecto facilito el link ************ que contiene una colección de POSTMAN en donde se encuentran dichos endpoints con la cual se pueden ayudar.

### Conexión a la base de datos fuera de docker (con puertos fijos)

## Las credenciales son:
- user:     root
- pasword:  password
- database: main
- host:     localhost
- port:     3307

## Nota:
- Si tiene problemas con los permisos de conexión, puede agregar este parámetro en la URL de conexión: ?allowPublicKeyRetrieval=true&useSSL=false