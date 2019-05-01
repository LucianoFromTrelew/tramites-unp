FROM php:apache

RUN apt-get update -yq && \
        apt-get install -yq iputils-ping git zip unzip libzip-dev && \
        docker-php-ext-configure zip --with-libzip && \
        docker-php-ext-install mysqli zip pdo_mysql && \
        apt-get clean && \
        rm -rf /var/cache/apt/*

ARG COMPOSER_INSTALL_DIR=/usr/local/bin
ARG COMPOSER_FILENAME=composer

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
        php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
        php composer-setup.php --install-dir="$COMPOSER_INSTALL_DIR" --filename="$COMPOSER_FILENAME" && \
        php -r "unlink('composer-setup.php');"

# Enable headers module
RUN a2enmod headers rewrite

# Taken from here:
# https://jtreminio.com/blog/running-docker-containers-as-current-host-user/

ARG USER_ID
ARG GROUP_ID

RUN if [ ${USER_ID:-0} -ne 0 ] && [ ${GROUP_ID:-0} -ne 0 ]; then \
    userdel -f www-data &&\
    if getent group www-data ; then groupdel www-data; fi &&\
    groupadd -g ${GROUP_ID} www-data &&\
    useradd -l -u ${USER_ID} -g www-data www-data &&\
    install -d -m 0755 -o www-data -g www-data /home/www-data &&\
    chown --changes --silent --no-dereference --recursive \
          --from=33:33 ${USER_ID}:${GROUP_ID} \
        /home/www-data \
        /var/www \
        /etc/apache2 \
;fi
        
USER www-data
