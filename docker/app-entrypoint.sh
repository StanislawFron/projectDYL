#!/bin/sh
set -e

until nc -z mariadb 3306; do
  sleep 3
done

php artisan migrate --force --seed

exec "$@"
