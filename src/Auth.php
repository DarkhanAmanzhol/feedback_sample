<?php

class Auth
{
    private int $user_id;
    public function __construct(private UserGateway $gateway)
    {
    }

    public function getUserID(): int
    {
        return $this->user_id;
    }

    public function authenticateAccessToken(): bool
    {
        $headers = apache_request_headers();
        if (!preg_match("/^Bearer\s+(.*)$/", $headers['Authorization'], $matches)) {
            http_response_code(400);
            echo json_encode(["message" => "Incomplete authorization header"]);
            return false;
        }

        $plain_text = base64_decode($matches[1], true);
        if ($plain_text === false) {
            http_response_code(400);
            echo json_encode(["message" => "Incomplete authorization header"]);
            return false;
        }

        $data = json_decode($plain_text, true);
        if ($data === null) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid json"]);
            return false;
        }

        $this->user_id = $data["id"];

        return true;
    }
}
