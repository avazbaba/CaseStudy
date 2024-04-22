<?php
require_once __DIR__ . '/vendor/autoload.php';

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

ORM::configure('mysql:host=' . $_ENV['MYSQL_HOST'] . ';dbname=' . $_ENV['MYSQL_DATABASE']);
ORM::configure('username', $_ENV['MYSQL_USER']);
ORM::configure('password', $_ENV['MYSQL_PASSWORD']);
?>
