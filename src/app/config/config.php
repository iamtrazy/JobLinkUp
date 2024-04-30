<?php

$password = $_ENV['MYSQL_ROOT_PASSWORD'];
// DB Params
define('DB_HOST', 'db');
define('DB_USER', 'root');
define('DB_PASS', $password);
define('DB_NAME', 'JobLinkUp');

  // App Root
  define('APPROOT', dirname(dirname(__FILE__)));
  // URL Root
  define('URLROOT', 'https://joblinkup.duckdns.org');
  // Site Name
  define('SITENAME', 'JobLinkUp');
