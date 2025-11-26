FROM php:8.2-apache

# Install MySQL (MariaDB)
RUN apt-get update && apt-get install -y mariadb-server && rm -rf /var/lib/apt/lists/*

# Enable PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy your code
COPY . /var/www/html/

# Copy startup script
COPY init.sh /init.sh
RUN chmod +x /init.sh

# Expose port 80
EXPOSE 80

# Run MySQL + Initialize DB + Start Apache
CMD ["/init.sh"]


