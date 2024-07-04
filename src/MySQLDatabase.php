<?php

require_once 'DatabaseInterface.php';

class MySQLDatabase implements DatabaseInterface
{
    private $db;
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function connect()
    {
        $this->db = new mysqli($this->config['host'], $this->config['username'], $this->config['password'], $this->config['dbname']);
        if ($this->db->connect_error) {
            throw new Exception('Connect Error (' . $this->db->connect_errno . ') ' . $this->db->connect_error);
        }
    }

    public function createTable()
    {
        $query = 'CREATE TABLE IF NOT EXISTS items (
            entity_id INT PRIMARY KEY,
            categoryName VARCHAR(255),
            sku VARCHAR(255),
            name VARCHAR(255),
            description TEXT,
            shortdesc TEXT,
            price FLOAT,
            link VARCHAR(255),
            image VARCHAR(255),
            brand VARCHAR(255),
            rating INT,
            caffeineType VARCHAR(255),
            count INT,
            flavored VARCHAR(255),
            seasonal VARCHAR(255),
            instock VARCHAR(255),
            facebook INT,
            isKCup INT
        )';
        $this->db->query($query);
    }

    public function insertItem($entity_id, $categoryName, $sku, $name, $description, $shortdesc, $price, $link, $image, $brand, $rating, $caffeineType, $count, $flavored, $seasonal, $instock, $facebook, $isKCup)
    {
        $query = 'INSERT INTO items (entity_id, categoryName, sku, name, description, shortdesc, price, link, image, brand, rating, caffeineType, count, flavored, seasonal, instock, facebook, isKCup) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('isssssdsssiisssiii', $entity_id, $categoryName, $sku, $name, $description, $shortdesc, $price, $link, $image, $brand, $rating, $caffeineType, $count, $flavored, $seasonal, $instock, $facebook, $isKCup);
        $stmt->execute();
    }

    public function close()
    {
        $this->db->close();
    }
}
?>
