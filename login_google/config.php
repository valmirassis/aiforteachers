<?php
$rootPath = dirname(__DIR__);

require $rootPath . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->load();

$GOOGLE_CLIENT_ID     = $_ENV['GOOGLE_CLIENT_ID'];
$GOOGLE_CLIENT_SECRET = $_ENV['GOOGLE_CLIENT_SECRET'];
$GOOGLE_REDIRECT_URI  = 'https://aiforteachers.com.br/login_google/login.php';