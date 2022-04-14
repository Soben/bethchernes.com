#!/bin/bash

PUID=${PUID:-33}
PGID=${PGID:-33}

if [ ! "$(id -u www-data)" -eq "$PUID" ]; then usermod -o -u "$PUID" www-data ; fi
if [ ! "$(id -g www-data)" -eq "$PGID" ]; then groupmod -o -g "$PGID" www-data ; fi

chown www-data:www-data -R /var/www

echo "
-------------------------------------
www-data GID/UID
-------------------------------------
www-data uid:    $(id -u www-data)
www-data gid:    $(id -g www-data)
-------------------------------------
"