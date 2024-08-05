#!/bin/bash

# Display the steps to the user

# Step 1: Install Composer dependencies
echo "Starting the installation process and installing dependecies..."
docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php83-composer:latest \
    composer install

# Step 2: Copy the .env file if it does not exist
if [ ! -f ".env" ]; then
  echo "Copying .env.example to .env..."
  cp .env.example .env
fi

# Step 3: Generate a new application key
echo "Generating application key..."
./vendor/bin/sail artisan key:generate

# Step 4: Start Laravel Sail in detached mode
echo "Starting Laravel Sail..."
./vendor/bin/sail up -d

# Step 5: Run database migrations
echo "Running database migrations..."
./vendor/bin/sail artisan migrate

# Final message
echo "Installation completed. You can now access the application at http://localhost:81"

# End of script