<?php

declare(strict_types=1);

require __DIR__ . "/bootstrap.php";

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode('/', $path);

$resource = $parts[2];

$id = $parts[3] ?? null;

$database = new Database(
    $_ENV["DB_HOST"],
    $_ENV["DB_NAME"],
    $_ENV["DB_USER"],
    $_ENV["DB_PASSWORD"]
);

// Check if user exists in route /api/user with GET method, need headers in it. (In case of admin)
if ($resource == "user" && $_SERVER["REQUEST_METHOD"] == "GET") {
    $user_gateway = new UserGateway($database);

    $auth = new Auth($user_gateway);

    if (!$auth->authenticateAccessToken()) {
        http_response_code(401);
        echo json_encode(["status" => false, "message" => "User does not exist"]);
        exit;
    }
    echo json_encode(["status" => true, "message" => "User exists"]);
    exit;
}

if ($resource != "feedbacks") {
    http_response_code(404);
    echo json_encode(["message" => "No such route exists"]);
    exit;
}

$headers = apache_request_headers();

$user_gateway = new UserGateway($database);

$auth = new Auth($user_gateway);

$is_admin = false;
if (array_key_exists('Authorization', $headers)) {
    // Check the token
    $auth->authenticateAccessToken();
    $is_admin = $user_gateway->isAdmin($auth->getUserID());
}


$feedback_gateway = new FeedbackGateway($database);

$controller = new FeedbackController($feedback_gateway, $is_admin);

$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
