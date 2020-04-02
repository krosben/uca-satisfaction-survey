FROM php:7.4-apache

# Avoid warnings by switching to noninteractive
ENV DEBIAN_FRONTEND=noninteractive

# This Dockerfile adds a non-root user with sudo access. Use the "remoteUser"
# property in devcontainer.json to use it. On Linux, the container user's GID/UIDs
# will be updated to match your local UID/GID (when using the dockerFile property).
# See https://aka.ms/vscode-remote/containers/non-root-user for details.
ARG USERNAME=vscode
ARG USER_UID=1000
ARG USER_GID=$USER_UID

# Set to false to skip installing zsh and Oh My ZSH!
ARG INSTALL_ZSH="true"

# Location and expected SHA for common setup script - SHA generated on release
ARG COMMON_SCRIPT_SOURCE="https://raw.githubusercontent.com/microsoft/vscode-dev-containers/master/script-library/common-debian.sh"
ARG COMMON_SCRIPT_SHA="dev-mode"

# Current php-cs-fixer version
# ARG PHP_CS_FIXER_VERSION=2.16.1
# ARG PHP_CS_FIXER_URL=https://github.com/FriendsOfPHP/PHP-CS-Fixer/releases/download/v$PHP_CS_FIXER_VERSION/php-cs-fixer.phar

# Install composer from official image
COPY --from=composer:1.9.3 /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

# Change APACHE_DOCUMENT_ROOT
ENV APACHE_DOCUMENT_ROOT /workspace/public

# Configure apt and install packages
RUN apt-get update \
  && apt-get -y install --no-install-recommends apt-utils dialog wget ca-certificates 2>&1 \
  #
  # Verify git, common tools / libs installed, add/modify non-root user, optionally install zsh
  && wget -q -O /tmp/common-setup.sh $COMMON_SCRIPT_SOURCE \
  && if [ "$COMMON_SCRIPT_SHA" != "dev-mode" ]; then echo "$COMMON_SCRIPT_SHA /tmp/common-setup.sh" | sha256sum -c - ; fi \
  && /bin/bash /tmp/common-setup.sh "$INSTALL_ZSH" "$USERNAME" "$USER_UID" "$USER_GID" \
  && rm /tmp/common-setup.sh \
  #
  # Intall php-cs-fixer
  # && curl -L $PHP_CS_FIXER_URL > /usr/local/bin/php-cs-fixer \
  # && chmod +x /usr/local/bin/php-cs-fixer \
  #
  # Install xdebug
  && install-php-extensions xdebug pdo_mysql \
  && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
  && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
  #
  # Change APACHE_DOCUMENT_ROOT
  && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
  && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
  #
  # Clean up
  && apt-get autoremove -y \
  && apt-get clean -y \
  && rm -rf /var/lib/apt/lists/* \
  && a2enmod rewrite

# Switch back to dialog for any ad-hoc use of apt-get
ENV DEBIAN_FRONTEND=dialog