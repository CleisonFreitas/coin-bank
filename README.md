# GREEN COIN BANK

## Description
Green Coin Bank is a platform focused on cryptocurrency assets. It provides values and descriptions for the major coins in the market, allowing users to stay informed about the latest trends and data.

## About the project structure
This project is built using Laravel Sail version 11.19.0 and runs on PHP 8.3. It follows a clean code approach with a modular architecture, including services, controllers, repositories for a well-organized codebase.

## Prerequisites
### To set up the project, ensure you have the following installed:
- Docker: Required to run Laravel Sail.
- PHP 8.3 (Optional): Needed for local development if not using Sail.
- Composer (Optional): Used for managing PHP dependencies if not using Sail.

## Setting up Dev
### 1. Clone the repository:
```
git clone https://github.com/your_user/coin-bank.git
cd green-coin-bank
```
### 2.Run the installer script:
```
./installer.sh
```
#### via composer:
```
./composer-installer.sh
```
The script will set up the project, install dependencies, configure the environment, start the Sail containers, and run the database migrations.

### 3. Access the application:
Open your browser and go to http://localhost:81 to check if the project is running.

## Manual Setup with Composer and Sail

### 1.Clone the Repository:

```
git clone https://github.com/yourusername/green-coin-bank.git
cd green-coin-bank
```

### 2.Install Composer Dependencies:
```
composer install
```

### 3.Copy the Environment File:
Create a .env file from the example provided:
```
cp .env.example .env
```

### 4.Generate Application Key:
Generate a new application key:
```
./vendor/bin/sail artisan key:generate
```

### 5.Start Laravel Sail:
Start the Sail environment in detached mode:
```
./vendor/bin/sail up -d
```

### 6.Run Database Migrations:
Apply database migrations:

```
./vendor/bin/sail artisan migrate
```

### 7. Access the application:
Open your browser and go to http://localhost:81 to check if the project is running.

## Api Reference
To use the project, you need a CoinAPI key. Obtain one from [CoinAPI][https://www.coinapi.io/get-free-api-key?email=]. Note that the free tier allows up to 100 requests per month.

### After get the key, set the env variable with the value of your key:
```
COIN_KEY=your_key
COIN_URL=https://rest.coinapi.io/v1
```

## Licensing
MIT
