FROM php:8.2-apache

# Install MySQL server (MariaDB)
RUN apt-get update && apt-get install -y mariadb-server && rm -rf /var/lib/apt/lists/*

# Enable PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files into Apache directory
COPY . /var/www/html/

# MySQL initialization: create DB and table
RUN service mysql start && \
    mysql -e "CREATE DATABASE IF NOT EXISTS postapi;" && \
    mysql -e "USE postapi; CREATE TABLE IF NOT EXISTS users ( id INT PRIMARY KEY, name VARCHAR(255), phone VARCHAR(20), image VARCHAR(255) );"

# Expose port 80
EXPOSE 80

# Start MySQL and Apache when container boots
CMD service mysql start && apache2-foreground
