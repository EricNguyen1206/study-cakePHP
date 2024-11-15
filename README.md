# cakephp-docker
A Docker Compose setup for containerized CakePHP Applications with automated setup script.

This setup spools up the following containers:

* **mysql** (8.0)
* **nginx** 
* **php-fpm** (php 7.4)
* **mailhog** (smtp server for testing)

## Quick Start

For those looking to get started quickly, follow these simple steps:

1. Download the ZIP file for this repo
2. Copy and update /cakephp/app/config/.env from /cakephp/app/config/.env.example
3. Copy and update /cakephp/app/config/.app_local.php from /cakephp/app/config/.app_local.example.php
4. Run the setup command: `cd docker && sh setup.sh
5. Wait for the script run source code setup success
6. After setup, you can access the website at [localhost:8180](http://localhost:8180/) and phpmyadmin at [localhost:8106](http://localhost:8106/)
