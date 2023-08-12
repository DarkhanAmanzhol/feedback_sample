<?php

declare(strict_types=1);

require __DIR__ . "/bootstrap.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    header("Allow: POST");
    exit;
}

$data = [
    "username" => $_POST['username'],
    "password" => $_POST['password']
];

if (!array_key_exists("username", $data) || !array_key_exists("password", $data)) {
    http_response_code(400);
    echo json_encode(["message" => "Missing Login creadentials"]);
    exit;
}

$database = new Database(
    $_ENV["DB_HOST"],
    $_ENV["DB_NAME"],
    $_ENV["DB_USER"],
    $_ENV["DB_PASSWORD"]
);

$user_gateway = new UserGateway($database);

$user = $user_gateway->getUser($data['username']);
if ($user === false || $user['password'] != $data['password']) { // without hashing, if needed, I could add password_verify() method instead.
    http_response_code(401);
    echo json_encode(["message" => "Invalid authentication"]);
    exit;
}

$payload = [
    "id" => $user['id'],
    "username" => $user['username']
];

// Can be used JWT instead of base64 for better security.
$access_token = base64_encode(json_encode($payload));

echo json_encode([
    "access_token" => $access_token
]);
