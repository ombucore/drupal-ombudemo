Site Name
============

## Requirements

## Development install steps

    git submodule update --init --recursive
    cp public/sites/default/settings.development.php public/sites/default/settings.php
    fab drupal.build:dev=yes

## Deployment

    fab {env} drupal.push:ref={commmit}

Other available deployment tasks:

    fab {env} drupal.build
    fab {env} drush.cc
    fab {env} drush.updatedb
