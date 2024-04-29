<?php

use Ifsnop\Mysqldump as IMysqldump;

function dump_database($path)
{
    try {
        $pasaword = $_ENV['MYSQL_ROOT_PASSWORD'];
        $dump = new IMysqldump\Mysqldump('mysql:host=db;dbname=JobLinkUp', 'root', $pasaword);
        $dump->start($path);
    } catch (\Exception $e) {
        echo 'mysqldump-php error: ' . $e->getMessage();
    }
}
