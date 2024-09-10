
FROM ebersoncosme/laravel-app
#Instalacao do composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#Diretorio de trabalho
WORKDIR /var/www/html

# Copiar os arquivos da aplicação Laravel para o contêiner
COPY . .

#Permissoes
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

#Expondo a porta 80
EXPOSE 80

#Iniciando o Apache
CMD ["apache2-foreground"]
