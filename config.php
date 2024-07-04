<?php

$config = [
    'db_type' => 'mysql', // or 'mysql' or 'sqlite' or 'pgsql'
    'db_path' => __DIR__ . '/data.db', // for SQLite
    'host' => 'localhost', // for MySQL and PostgreSQL
    'username' => 'root', // for MySQL and PostgreSQL
    'password' => '', // for MySQL and PostgreSQL
    'dbname' => 'db_datafeed', // for MySQL and PostgreSQL
    'port' => '5432', // for PostgreSQL
    'log_file' => __DIR__ . '/app.log',
    // Change here if file type is csv
    'file_type' => 'xml', //'xml' or 'csv'
    'file_path' => __DIR__ . '/feed.xml', // path to XML or CSV file
];
