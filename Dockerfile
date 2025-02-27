# Use an official PHP image from Docker Hub
FROM php:8.1-apache

# Enable the Apache rewrite module
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the PHP app files into the container
COPY . /var/www/html/

# Expose port 80 for Apache
EXPOSE 80

# Set the command to run Apache in the foreground
CMD ["apache2-foreground"]
