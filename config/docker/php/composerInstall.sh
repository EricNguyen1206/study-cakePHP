#!/bin/sh

# Fetch the expected checksum
EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"

# Download the installer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

# Calculate the actual checksum
ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

# Verify the checksum
if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]; then
    >&2 echo 'ERROR: Invalid installer checksum'
    rm composer-setup.php
    exit 1
fi

# Run the installer
php composer-setup.php --quiet

# Check if the composer.phar was created successfully
if [ ! -f composer.phar ]; then
    >&2 echo 'ERROR: composer.phar was not created'
    exit 1
fi

RESULT=$?
rm composer-setup.php

# Move composer.phar to the appropriate location
mv composer.phar /usr/local/bin/composer

exit $RESULT