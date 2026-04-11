<?php

namespace Deployer;

// Load environment variables from .env file
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if (!array_key_exists($name, $_ENV) && !array_key_exists($name, $_SERVER)) {
            putenv("$name=$value");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

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
    run('npm ci');
    run('npm run build');
});

after('deploy:vendors', 'npm-build');
