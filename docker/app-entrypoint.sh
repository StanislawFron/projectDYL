#!/bin/sh
set -e

until mysql -h mariadb -uroot -p"$MYSQL_ROOT_PASSWORD" -e "SELECT 1" "$MYSQL_DATABASE" >/dev/null 2>&1; do
  echo "Waiting for database..."
  sleep 3
done

if [ "$APP_DATABASE_ENV" = "local" ]; then
    php artisan migrate:fresh --seed --force
fi

if [ "$APP_DATABASE_ENV" = "production" ]; then
    php artisan migrate
    php artisan optimize
fi

php artisan schedule:work &
php artisan queue:listen &
php artisan octane:start --server=frankenphp --host=0.0.0.0 --port=8000 --watch

exec "$@"
