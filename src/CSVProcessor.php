<?php

require_once 'Logger.php';
require_once 'DatabaseInterface.php';

class CSVProcessor
{
    private $logger;
    private $db;

    public function __construct($logger, $db)
    {
        $this->logger = $logger;
        $this->db = $db;
    }

    public function process($csvFile)
    {
        if (!file_exists($csvFile)) {
            $this->logger->log("File not found: $csvFile");
            return;
        }

        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            fgetcsv($handle); // Skip the header row
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                list($entity_id, $categoryName, $sku, $name, $description, $shortdesc, $price, $link, $image, $brand, $rating, $caffeineType, $count, $flavored, $seasonal, $instock, $facebook, $isKCup) = $data;

                try {
                    $this->db->insertItem($entity_id, $categoryName, $sku, $name, $description, $shortdesc, $price, $link, $image, $brand, $rating, $caffeineType, $count, $flavored, $seasonal, $instock, $facebook, $isKCup);
                } catch (Exception $e) {
                    $this->logger->log("Error inserting item with entity_id $entity_id: " . $e->getMessage());
                }
            }
            fclose($handle);
        } else {
            $this->logger->log("Error opening file: $csvFile");
        }
    }
}
