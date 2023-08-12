<?php

class FeedbackGateway
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    public function getAll(bool $is_admin): array
    {
        $order = $_GET['order'] ?? "created_at";
        $direction = $_GET['direction'] ?? "desc";

        $sql = "SELECT * FROM feedbacks WHERE status = 1 ORDER BY " . $order . " " . $direction;

        // Check if admin, then we can see all statuses, otherwise for public only accepted feedbacks are available
        if ($is_admin) {
            $sql = "SELECT * FROM feedbacks ORDER BY " . $order . " " . $direction;
        }

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get(string $id): array | false
    {
        $sql = "SELECT * FROM feedbacks WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO feedbacks (username, email, image_path, message) 
                    VALUES (:username, :email, :image_path, :message)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":username", $data['username'], PDO::PARAM_STR);
        $stmt->bindValue(":email", $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(":message", $data['message'], PDO::PARAM_STR);

        if (empty($data['image_path'])) {
            $stmt->bindValue(":image_path", null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(":image_path", $data['image_path'], PDO::PARAM_INT);
        }

        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function update(string $id, array $data): int
    {
        $fields = [];

        if (!empty($data['username'])) {
            $fields['username'] = [$data['username'], PDO::PARAM_STR];
        }
        if (!empty($data['email'])) {
            $fields['email'] = [$data['email'], PDO::PARAM_STR];
        }
        if (!empty($data['image_path'])) {
            $fields['image_path'] = [
                $data['image_path'],
                $data['image_path'] === null ? PDO::PARAM_NULL : PDO::PARAM_STR
            ];
        }
        if (array_key_exists('status', $data)) {
            $fields['status'] = [$data['status'], PDO::PARAM_BOOL];
        }
        if (!empty($data['message'])) {
            $fields['message'] = [$data['message'], PDO::PARAM_STR];
            $fields['is_updated_by_admin'] = [true, PDO::PARAM_BOOL]; // Can be used id and is_admin to check whether it is admin who is updating, but this should be enough so far.
        }

        if (!empty($fields)) {
            $sets = array_map(function ($value) {
                return "$value = :$value";
            }, array_keys($fields));

            $sql = "UPDATE feedbacks" . " SET " . implode(", ", $sets) . " WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            foreach ($fields as $name => $values) {
                $stmt->bindValue(":$name", $values[0], $values[1]);
            }

            $stmt->execute();

            return $stmt->rowCount();
        }

        return 0;
    }
}
