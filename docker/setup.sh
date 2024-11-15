#!/bin/bash

# Exit immediately if a command exits with a non-zero status
set -e

# Start the Docker containers
echo "Starting Docker containers..."
docker-compose up -d

# Wait for the MySQL container to be ready
echo "Waiting for MySQL to be ready..."
until docker-compose exec myapp-mysql mysqladmin ping --silent; do
    sleep 1
done

# Install Composer dependencies
echo "Installing Composer dependencies..."
docker-compose exec myapp-php-fpm bash -c "cd app && composer install"

# Run migrations
echo "Running migrations..."
docker-compose exec myapp-php-fpm bash -c "cd app && bin/cake migrations migrate"
# Wait for migrations to complete successfully
echo "Waiting for migrations to complete..."
while ! docker-compose exec myapp-mysql mysql -u myapp -pmyapp myapp -e "SHOW TABLES LIKE 'notes'" 2>/dev/null | grep -q "notes" || \
      ! docker-compose exec myapp-mysql mysql -u myapp -pmyapp myapp -e "SHOW TABLES LIKE 'users'" 2>/dev/null | grep -q "users"; do
    echo "Migration still in progress..."
    sleep 2
done
echo "Migrations completed successfully"

# Run seeders
echo "Seeding the database..."
docker-compose exec myapp-php-fpm bash -c "cd app && bin/cake migrations seed --seed UsersSeed"
sleep 3
docker-compose exec myapp-php-fpm bash -c "cd app && bin/cake migrations seed --seed NotesSeed"

echo "Database setup completed successfully."