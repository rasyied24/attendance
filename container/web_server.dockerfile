FROM nginx:latest

WORKDIR var/www/html

COPY attendance /var/www/html

COPY nginx/nginx.conf /etc/nginx/nginx.conf

