FROM pimcore/pimcore:php8.2-debug-latest

## PHP AMQP
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod 777 /usr/local/sbin/php-fpm
RUN chown -R www-data:www-data /usr/local/sbin/php-fpm

RUN apt update -y && apt-get install -y librabbitmq-dev libssl-dev build-essential autoconf iputils-ping supervisor
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
  install-php-extensions amqp


## Додавання PostgreSQL драйверу
RUN install-php-extensions pdo_pgsql pgsql
# RUN apt update -y && apt-get install -y librabbitmq-dev libssl-dev build-essential
# RUN pecl install amqp
# RUN docker-php-ext-enable amqp
