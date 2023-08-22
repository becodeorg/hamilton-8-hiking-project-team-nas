<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class TagDatabase extends Database
{
    public function findAll(string $hikeId): array
    {
        $sql = "SELECT tags.* FROM tags
        LEFT JOIN hikes_tags ON hikes_tags.tag_id = tags.ID
        WHERE hikes_tags.hike_id = ?";

        $stmt = $this->query(
            $sql,
            [$hikeId]
        );
        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tags;
    }
    public function find(string $tagId): array|false
    {
        $sql = "SELECT * FROM tags WHERE ID = ?";

        $stmt = $this->query(
            $sql,
            [$tagId]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
