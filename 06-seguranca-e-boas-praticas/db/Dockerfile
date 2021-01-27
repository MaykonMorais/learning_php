FROM mysql:latest

VOLUME ./db_scripts:database.sql/docker-entrypoint-initdb.d/db.sql

ENV MYSQL_ROOT_PASSWORD=1234 \
    MYSQL_DATABASE=fullstackphp \
    MYSQL_USER=admin \
    MYSQL_PASSWORD=1234

VOLUME /var/lib/mysql

EXPOSE 3306