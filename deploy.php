<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'git@github.com:simphiwehlabisa/dotcomapp.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 


// Shared files/dirs between deploys 
add('shared_files', ['.env']);
add('shared_dirs', [
    'storage',
]);

// Writable dirs by web server 
set('writable_mode', 'chmod');

//global php and composer
set('bin/php', 'php');
set('bin/composer', 'composer');
set('composer_options', 'install --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader');

// Hosts
set('http_user', 'csdonjwyzd');

host('csdonline.co.za')
    ->user('csdonjwyzd')
    ->port(22)
    ->set('deploy_path', '/usr/home/csdonjwyzd/public_html');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

