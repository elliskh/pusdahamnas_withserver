#!/bin/bash
TIMESTAMP=$(date +"%F")
BACKUP_DIR="/var/www/html/backup/$TIMESTAMP"
MYSQL_USER="dataham@komnas"
MYSQL_PASSWORD="datahamk0mn4s"
MYSQL_DATABASE="dataham"

mkdir -p "$BACKUP_DIR"
mysqldump -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" > "$BACKUP_DIR/$MYSQL_DATABASE.sql"
