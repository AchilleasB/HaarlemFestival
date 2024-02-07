<?php

session_start();

require __DIR__ . '/../router/patternRouter.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new PatternRouter();
$router->route($uri);