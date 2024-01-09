# See: https://hub.docker.com/_/wordpress/

# ARG PHP_VERSION=7.4
ARG WP_VERSION=6.4.1
ARG PHP_VERSION=8.2

#*** If you need a specific WP or PHP Version, follow this convention:
#     NOTE: WP Version is required if doing PHP Version
# FROM wordpress:${WP_VERSION}-php${PHP_VERSION}
FROM wordpress:${WP_VERSION}-php${PHP_VERSION}-apache

# Install WPCLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && chmod +x wp-cli.phar && mv wp-cli.phar /usr/bin/wp

# Install vim/nano for usage
RUN apt-get update && apt-get install -y vim nano

# Change working Directory
WORKDIR /var/www/html

# Spin up with the permissions modification first.
# CMD /etc/init.d/change-uid-gid.sh && apache2-foreground