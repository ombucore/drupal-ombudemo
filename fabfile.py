from fabric.api import task, env, cd
from butter import drush, deploy, drupal
from fabric.contrib import files
from fabric.operations import run

env.repo_type = 'git'
env.repo_url = 'git@bitbucket.org:ombu/drupal-ombudemo.git'
env.use_ssh_config = 'true'

# Global environment settings
env.site_name = 'OMBU Demo'
env.db_db = 'ombudemo'
env.public_path = 'public'
env.site_profile = 'ombudemo_profile'

# Dev modules to install during site build
env.dev_modules = 'devel devel_generate context_ui views_ui diff'

# Host settings
@task
def qa():
    """
    The qa server definition
    """
    env.hosts = ['pepe.ombudev.com']
    env.host_type = 'qa'
    env.host_webserver_user = 'www-data'
    env.host_site_path = '/var/www/qa23'
    env.public_path = 'current'
    env.db_db = 'qa23'
    env.db_user = 'phpuser'
    env.db_pw = 'meh'
    env.db_host = 'devdb1.ombudev.com'

@task
def staging():
    """
    The staging server definition
    """
    env.hosts = ['pepe.ombudev.com']
    env.host_type = 'staging'
    env.host_webserver_user = 'www-data'
    env.host_site_path = '/var/www/stage23'
    env.public_path = 'current'
    env.db_db = 'stage23'
    env.db_user = 'phpuser'
    env.db_pw = 'meh'
    env.db_host = 'devdb1.ombudev.com'

@task
def jmeter(host):
    """
    Runs jmeter and reports results
    """
    if not env.hosts:
        from fabric.operations import local
        from fabric.api import lcd
        run_function = local
        cd_function = lcd

        # Ensure drupal.build can be run in any directory locally.
        import os
        env.host_site_path = os.path.dirname(env.real_fabfile)
    else:
        run_function = run
        cd_function = cd

    with cd_function(env.host_site_path + '/tests/jmeter'):
        run_function('rm jmeter-results.jtl || :')
        run_function('jmeter -n -t DrupalStress.jmx -l ./jmeter-results.jtl -Jhost=%s -p user.properties > /dev/null' % host)
        run_function('xsltproc jmeter-results-cli-report.xsl jmeter-results.jtl')
