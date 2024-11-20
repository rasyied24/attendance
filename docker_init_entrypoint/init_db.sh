#!/bin/bash

PGPASSWORD=$POSTGRES_PASSWORD
# PGUSER=$POSTGRES_USER
# PGDATABASE=$POSTGRES_DB


psql -c "CREATE DATABASE attendance"


if [ ! -f "/database-data/attendance.sql" ]; then
  echo "Error: attendance.sql file not found in database-data folder!"
  exit 1
fi

pg_restore -U postgres  -d attendance -1  database-data/attendance.sql

echo "Attendance database created and data imported successfully!"