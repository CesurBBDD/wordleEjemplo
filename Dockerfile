FROM francarmona/docker-ubuntu16-apache2-php7-mssql_client
COPY ./src /var/www/
EXPOSE 80