<?php

class UserGateway
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    public function getUser(string $username): array | false
    {
        $sql = "SELECT * FROM users WHERE username = :username";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":username", $username, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isAdmin(int $id): bool
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user['is_admin'];
    }
}
