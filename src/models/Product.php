<?php

namespace models;

class Product extends Database
{
    public function getAllProduct(): array|bool
    {
        $sql = "SELECT * FROM hikes LIMIT 20";
        $result = Database::query($sql);
        return $result->fetchAll();
    }

    public function getProductInfo(string $name): array|bool
    {
        $sql = "SELECT * FROM hikes WHERE name = :name";
        $result = Database::query($sql, ["name" => $name]);
        return $result->fetch();
    }
}