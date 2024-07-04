<?php

require_once 'Logger.php';
require_once 'DatabaseInterface.php';

class XMLProcessor
{
    private $logger;
    private $db;

    public function __construct($logger, $db)
    {
        $this->logger = $logger;
        $this->db = $db;
    }

    public function process($xmlFile)
    {
        if (!file_exists($xmlFile)) {
            $this->logger->log("File not found: $xmlFile");
            return;
        }

        $xml = simplexml_load_file($xmlFile);

        foreach ($xml->item as $item) {
            $entity_id = (int) $item->entity_id;
            $categoryName = (string) $item->CategoryName;
            $sku = (string) $item->sku;
            $name = (string) $item->name;
            $description = (string) $item->description;
            $shortdesc = (string) $item->shortdesc;
            $price = (float) $item->price;
            $link = (string) $item->link;
            $image = (string) $item->image;
            $brand = (string) $item->Brand;
            $rating = (int) $item->Rating;
            $caffeineType = (string) $item->CaffeineType;
            $count = (int) $item->Count;
            $flavored = (string) $item->Flavored;
            $seasonal = (string) $item->Seasonal;
            $instock = (string) $item->Instock;
            $facebook = (int) $item->Facebook;
            $isKCup = (int) $item->IsKCup;

            try {
                $this->db->insertItem($entity_id, $categoryName, $sku, $name, $description, $shortdesc, $price, $link, $image, $brand, $rating, $caffeineType, $count, $flavored, $seasonal, $instock, $facebook, $isKCup);
            } catch (Exception $e) {
                $this->logger->log("Error inserting item with entity_id $entity_id: " . $e->getMessage());
            }
        }
    }
}
?>
