#!/bin/sh
# To run the tests for this package, we need a working installation of Drupal. Drupal has already been downloaded as a
# dev dependency, but we still need to install it. I've also made the very unlikely assumption that you don't have
# Drush installed. We use the locally managed version of Drush to install the Composer managed Drupal installation using
# an SQLite database.

# Tl;dr - We install Drupal with an sqlite database for testing.

# The command to get the site installed is already long anough as it is, this also makes it quicker to change if I ever
# have to.
ADMIN_USER="admin"
ADMIN_PASSWORD="admin"
ADMIN_MAIL="null@dev.null"
PATH_TO_DRUPAL="$PWD/vendor/drupal/drupal"
MYSQL_URL="mysql://root@localhost/drupal_codeception_test"

./vendor/bin/drush site-install \
    --db-su=root \
    --db-url=${MYSQL_URL} \
    --account-name=${ADMIN_USER} \
    --account-pass=${ADMIN_PASSWORD} \
    --account-mail=${ADMIN_MAIL} \
    -r ${PATH_TO_DRUPAL} \
    -y
