#!/bin/bash

# When we're done testing we should give the option to blat the sqlite database,
PATH_TO_DRUPAL="$PWD/vendor/drupal/drupal"
PATH_TO_SQLITE_DATABASE="${PATH_TO_DRUPAL}/sites/all/files/.ht.sqlite"

rm ${PATH_TO_SQLITE_DATABASE} > /dev/null 2>&1

echo "Test database removed from ${PATH_TO_SQLITE_DATABASE}."