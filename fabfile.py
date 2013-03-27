from fabric.api import task, env, cd
from butter import drush, deploy, drupal
from fabric.contrib import files
from fabric.operations import run

env.repo_type = 'git'
env.repo_url = 'git@bitbucket.org:ombu/drupal-tiles-demo.git'
env.use_ssh_config = 'true'

# Global environment settings
env.site_name = 'Tiles Demo'
env.db_db = 'tiles'
env.public_path = 'public'
env.site_profile = 'ombuprofile'

# Dev modules to install during site build
env.dev_modules = 'devel devel_generate context_ui views_ui diff'

# Host settings
@task
def qa():
    """
    The qa server definition
    """
    # TODO: fill out this info with the correct QA specs
    # env.hosts = ['ombu@paco.ombuweb.com:34165']
    # env.host_type = 'qa'
    # env.user = 'ombu'
    # env.host_webserver_user = 'www-data'
    # env.host_site_path = '/vol/main/qa/qaX'
    # env.public_path = 'current'
    # env.db_db = 'tiles'
    # env.db_user = 'phpuser'
    # env.db_pw = 'meh'
    # env.db_host = 'localhost'

@task
def staging():
    """
    The staging server definition
    """
    # TODO: fill out this info with the correct Staging specs
    env.hosts = ['ombu@d2.ombuweb.com:34165']
    env.host_type = 'staging'
    env.user = 'ombu'
    env.host_webserver_user = 'www-data'
    env.host_site_path = '/home/ombu/stage/stage5'
    env.public_path = 'current'
    env.db_db = 'tiles_stage'
    env.db_user = 'phpuser'
    env.db_pw = 'meh'
    env.db_host = 'localhost'
