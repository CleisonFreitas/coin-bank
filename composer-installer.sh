#!/bin/bash

cd green-coin-bank
# Ensure the script is run from the project root directory
if [ ! -f "composer.json" ]; then
  echo "Error: This script must be run from the project root directory."
  exit 1
fi

# Display the steps to the user
echo "Starting the installation process..."

# Step 1: Install Composer dependencies
echo "Installing Composer dependencies..."
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
