#Usando a imagem oficial do PHP com servidor Apache
FROM php:8.1-apache

#Extensoes necessarias do PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql

#Instalacao do composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#Diretorio de trabalho
WORKDIR /var/www/html

#Copiando os arquivos da aplicacao Laravel para o conteiner
COPY . .

#Permissoes
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

#Expondo a porta 80
EXPOSE 80

#Iniciando o Apache
CMD ["apache2-foreground"]