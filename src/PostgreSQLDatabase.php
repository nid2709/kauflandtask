<?php

require_once 'DatabaseInterface.php';

class PostgreSQLDatabase implements DatabaseInterface
{
    private $db;
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function connect()
    {
        $dsn = "pgsql:host={$this->config['host']};dbname={$this->config['dbname']};port={$this->config['port']}";
        $this->db = new PDO($dsn, $this->config['username'], $this->config['password']);
    }

    public function createTable()
    {
        $query = 'CREATE TABLE IF NOT EXISTS items (
            entity_id SERIAL PRIMARY KEY,
            categoryName VARCHAR(255),
            sku VARCHAR(255),
            name VARCHAR(255),
            description TEXT,
            shortdesc TEXT,
            price REAL,
            link VARCHAR(255),
            image VARCHAR(255),
            brand VARCHAR(255),
            rating INTEGER,
            caffeineType VARCHAR(255),
            count INTEGER,
            flavored VARCHAR(255),
            seasonal VARCHAR(255),
            instock VARCHAR(255),
            facebook INTEGER,
            isKCup INTEGER
        )';
        $this->db->exec($query);
    }

    public function insertItem($entity_id, $categoryName, $sku, $name, $description, $shortdesc, $price, $link, $image, $brand, $rating, $caffeineType, $count, $flavored, $seasonal, $instock, $facebook, $isKCup)
    {
        $query = 'INSERT INTO items (entity_id, categoryName, sku, name, description, shortdesc, price, link, image, brand, rating, caffeineType, count, flavored, seasonal, instock, facebook, isKCup) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->db->prepare($query);
        $stmt->execute([$entity_id, $categoryName, $sku, $name, $description, $shortdesc, $price, $link, $image, $brand, $rating, $caffeineType, $count, $flavored, $seasonal, $instock, $facebook, $isKCup]);
    }

    public function close()
    {
        $this->db = null;
    }
}
