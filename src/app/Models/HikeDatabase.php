<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class HikeDatabase extends Database
{
    public function findAll(int $limit = 0): array
    {
        if ($limit === 0) {
            $sql = "SELECT * FROM hikes";
        } else {
            $sql = "SELECT * FROM hikes LIMIT " . $limit;
        }
        $stmt = $this->query($sql);
        $hikes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $hikes;
    }

    public function find(string $hikeId): array|false
    {
        $sql = "SELECT * FROM hikes WHERE ID = ?";

        $stmt = $this->query(
            $sql,
            [$hikeId]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
