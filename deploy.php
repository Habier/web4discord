<?php

namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/Habier/web4discord.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host(getenv('DEPLOY_HOSTNAME'))
    ->set('remote_user', getenv('REMOTE_USER'))
    ->set('deploy_path', getenv('DEPLOY_PATH'))
    ->set('ssh_multiplexing', false);

// Hooks

after('deploy:failed', 'deploy:unlock');


// Run after code deployment
task('npm-build', function () {
    cd('{{release_path}}');
    run('npm install');
    run('npm run build');
    run("php -r 'opcache_reset();'");
});

after('deploy:vendors', 'npm-build');
