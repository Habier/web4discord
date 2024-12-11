<?php

namespace Deployer;

require __DIR__ . '/vendor/autoload.php';
require 'recipe/laravel.php';

use Dotenv\Dotenv;
ini_set('variables_order', 'EGPCS');

//Avoid loading from .env if deploy.yml is involved
if (!($_ENV['DEPLOY_HOSTNAME'] ?? null)) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

// Config

set('repository', 'https://github.com/Habier/web4discord.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host($_ENV['DEPLOY_HOSTNAME'])
    ->set('remote_user', $_ENV['REMOTE_USER'])
    ->set('deploy_path', $_ENV['DEPLOY_PATH'])
    ->set('ssh_multiplexing', false);

// Hooks

after('deploy:failed', 'deploy:unlock');
