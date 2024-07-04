<?php

require_once 'DatabaseInterface.php';

class SQLiteDatabase implements DatabaseInterface
{
    private $db;
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function connect()
    {
        $this->db = new PDO('sqlite:' . $this->config['db_path']);
    }

    public function createTable()
    {
        $query = 'CREATE TABLE IF NOT EXISTS items (
            entity_id INTEGER PRIMARY KEY,
            categoryName TEXT,
            sku TEXT,
            name TEXT,
            description TEXT,
            shortdesc TEXT,
            price REAL,
            link TEXT,
            image TEXT,
            brand TEXT,
            rating INTEGER,
            caffeineType TEXT,
            count INTEGER,
            flavored TEXT,
            seasonal TEXT,
            instock TEXT,
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
?>
