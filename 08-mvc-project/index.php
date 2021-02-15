<?php

require __DIR__ . "/vendor/autoload.php";

use Source\Core\Email;

$email = new Email();

$email->bootstrap("Test a email", "<h1>Test</h1>", "maykons501@gmail.com", "Maykon  Morais");

$email->send();
