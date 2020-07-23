<?php
require_once __DIR__."/vendor/autoload.php";
$file = fopen($argv[1], 'r');
\Julfiker\Application::getInstance()
          ->run()
          ->handleInput($file);