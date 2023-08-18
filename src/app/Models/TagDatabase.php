<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class TagDatabase extends Database
{
    public function findAll(string $hikeId): array
    {
        $sql = "SELECT name FROM tags
        LEFT JOIN hikes_tags ON hikes_tags.tag_id = tags.ID
        WHERE hikes_tags.hike_id = ?";

        $stmt = $this->query(
            $sql,
            [$hikeId]
        );
        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tags;
    }
}
