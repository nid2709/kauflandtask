<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/Logger.php';
require_once __DIR__ . '/SQLiteDatabase.php';
require_once __DIR__ . '/MySQLDatabase.php';
require_once __DIR__ . '/PostgreSQLDatabase.php';
require_once __DIR__ . '/XMLProcessor.php';
require_once __DIR__ . '/CSVProcessor.php';

// Initialize Logger
$logger = new Logger($config['log_file']);

// Initialize Database
$dbType = $config['db_type'];
$db = null;
if ($dbType === 'sqlite') {
    $db = new SQLiteDatabase($config);
} elseif ($dbType === 'mysql') {
    $db = new MySQLDatabase($config);
} elseif ($dbType === 'pgsql') {
    $db = new PostgreSQLDatabase($config);
} else {
    $logger->log("Database type can not be empty!");
}

if ($db) {
    $db->connect();
    $db->createTable();

    // Determine file type and process accordingly
    $fileType = $config['file_type'];
    if ($fileType === 'xml') {
        $xmlProcessor = new XMLProcessor($logger, $db);
        $xmlProcessor->process($config['file_path']);
    } elseif ($fileType === 'csv') {
        $csvProcessor = new CSVProcessor($logger, $db);
        $csvProcessor->process($config['file_path']);
    } else {
        $logger->log("Invalid file type: $fileType");
    }

    // Close Database Connection
    $db->close();
} else {
    $logger->log("Invalid database type: $dbType");
}
