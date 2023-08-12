<?php

namespace Helpers;

class ResponseFeedback
{
    public static function methodNotAllowed(string $allowed_methods): void
    {
        http_response_code(405);
        header("Allow: $allowed_methods");
    }

    public static function notFound(string $id)
    {
        http_response_code(404);
        echo json_encode(["message" => "Feedback with ID $id not found"]);
    }

    public static function created(string $id): void
    {
        http_response_code(201);
        echo json_encode(["message" => "Feedback created", "id" => $id]);
    }

    public static function unprocessableEntity(array $errors): void
    {
        http_response_code(422);
        echo json_encode(["errors" => $errors]);
    }

    public static function internalServerError(string $message): void
    {
        http_response_code(500);
        echo json_encode(["message" => $message]);
    }

    public static function badRequest(string $message): void
    {
        http_response_code(400);
        echo json_encode(["message" => $message]);
    }

    public static function forbidden(string $message): void
    {
        http_response_code(403);
        echo json_encode(["message" => $message]);
    }

    public static function getValidationError(array $data, bool $is_new = true): array
    {
        $errors = [];

        if ($is_new && empty($data['username'])) {
            $errors[] = "Имя обязателен!";
        }
        if ($is_new && empty($data['email'])) {
            $errors[] = "Почта обязателен!";
        }
        if (!empty($data['email'])) {
            if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
                $errors[] = "Указанный формат почты неправелен!";
            }
        }
        if ($is_new && empty($data['message'])) {
            $errors[] = "Отзыв обязателен!";
        }

        return $errors;
    }
}
