<?php
require '../vendor/autoload.php';
use Pecee\SimpleRouter\SimpleRouter as Router;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();