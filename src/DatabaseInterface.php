<?php

interface DatabaseInterface
{
    public function connect();
    public function createTable();
    public function insertItem($entity_id, $categoryName, $sku, $name, $description, $shortdesc, $price, $link, $image, $brand, $rating, $caffeineType, $count, $flavored, $seasonal, $instock, $facebook, $isKCup);
    public function close();
}
?>
