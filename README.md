OMBU Demo Site
============

This repository tracks our OMBU demo site. 

Most of the code for this repo is the result of running
[drupal-installer](https://github.com/ombu/drupal-installer). The code to
generate this demo site through the installer is:

    drush drupal-installer --db-url=mysql://user:pass@localhost/ombudemo --demo

Unique components are:

- `ombudemo_profile`: a profile containing configuration and content for demo
  site.
- `fabfile.py`: contains host definition where this site is deployed.

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
