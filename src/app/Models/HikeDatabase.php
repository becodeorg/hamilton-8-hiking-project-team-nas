<?php

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
    public function findHikesForTag(string $tagId): array
    {
        $sql = "SELECT hikes.* FROM hikes
    LEFT JOIN hikes_tags ON hikes_tags.hike_id = hikes.ID
    WHERE hikes_tags.tag_id = ?";

        $stmt = $this->query(
            $sql,
            [$tagId]
        );

        $hikes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $hikes;
    }
    public function getAllHike(): array|bool
    {
        $sql = "SELECT hikes.*, users.nickname FROM hikes JOIN users ON hikes.id = users.id";
        $result = Database::query($sql);
        return $result->fetchAll();
    }
}
