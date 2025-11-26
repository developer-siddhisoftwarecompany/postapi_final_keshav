#!/bin/bash

# Start MySQL
service mysql start

# Wait for MySQL
sleep 5

# Create DB and table if not exist
mysql -u root -e "CREATE DATABASE IF NOT EXISTS postapi;"
mysql -u root -D postapi -e "CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    phone VARCHAR(20),
    image VARCHAR(255)
);"

# Start Apache in foreground
apache2-foreground
