# Use PHP com Apache
FROM php:8.1-apache

# Instalar extensões PHP necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar arquivos da aplicação
COPY . /var/www/html/

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Criar diretórios necessários
RUN mkdir -p /var/www/html/cache /var/www/html/logs /var/www/html/tmp
RUN chmod 777 /var/www/html/cache /var/www/html/logs /var/www/html/tmp

# Expor porta
EXPOSE 80

# Comando de inicialização
CMD ["apache2-foreground"]
