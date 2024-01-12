# Use an official PHP runtime as a parent image
FROM php:7.3-apache


COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions pdo pdo_mysql odbc pdo_odbc pdo_sqlite  mysqli zip @composer
 
RUN a2enmod rewrite

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
#COPY . /var/www/html
 
# Make port 80 available to the world outside this container
EXPOSE 80
 

# Run apache when the container launches
CMD ["apache2-foreground"]
 
