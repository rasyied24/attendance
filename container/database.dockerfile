FROM postgres:latest

COPY database /database-data

COPY /docker_init_entrypoint/init_db.sh /docker-entrypoint-initdb.d

RUN chown -R postgres:postgres /var/lib/postgresql
RUN chmod -R 700 /var/lib/postgresql