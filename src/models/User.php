<?php

namespace models;

class User extends Database{
    /**
     * @param string $email
     * 
     * @return array
     */
    public function getUserByEmail(string $email): array|bool
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $result = Database::query($sql, ["email" => $email]
    );
    return $result->fetch();
    }
    /**
     * @param array $param
     * 
     * @return array
     */
    public function getUserByUsernameAndEmail(array $param): array|bool
    {
        $sql = "SELECT * FROM users WHERE nickname = :nickname OR email = :email";
        $result = Database::query(
            $sql, 
            $param
    );
    return $result->fetch();
    }
    public function insertNewUser(array $param): array|bool
    {
        $sql = "INSERT INTO users
            (firstname, lastname, nickname, email, password)
            VALUES
            (:firstname, :lastname, :nickname, :email, :password)";
        $result = Database::exec($sql, $param);
        return [
            "bool" => $result,
            "uid" => Database::lastInsertId()
        ];
    }
    public function getHikeByUserId(string|int $id): array|bool
    {
        $sql = "SELECT * FROM Hikes WHERE id = :id";
        $result = Database::query($sql, ["id" => $id]);
        return $result->fetchAll();
    }

    public function updateUserFirstnameAndLastname(array $param): bool
    {
        $sql = "UPDATE users SET firstname = :firstname AND lastname = :lastname WHERE id = :id";
        return Database::exec($sql, $param);
    }

    public function updateUserFirstname(array $param): bool
    {
        $sql = "UPDATE users SET firstname = :firstname WHERE id = :id";
        return Database::exec($sql, $param);
    }

    public function updateUserLastname(array $param): bool
    {
        $sql = "UPDATE users SET lastname = :lastname WHERE id = :id";
        return Database::exec($sql, $param);
    }
}