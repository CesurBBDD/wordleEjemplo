FROM francarmona/docker-ubuntu16-apache2-php7-mssql_client
COPY ./src/index.php /var/www/
COPY ./src/guardarintento.php /var/www/
EXPOSE 80