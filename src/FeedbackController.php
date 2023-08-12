<?php

use Helpers\ResponseFeedback;

class FeedbackController
{
    public function __construct(private FeedbackGateway $gateway, private bool $is_admin)
    {
    }
    public function processRequest(string $method, ?string $id): void
    {
        if ($id === null) {
            if ($method == "GET") {
                echo json_encode($this->gateway->getAll($this->is_admin));
            } elseif ($method == "POST") {
                $image_name = $_FILES['file']['name'];
                if ($image_name) {
                    $image_path = "uploads/" . $image_name;

                    $extension = explode("/", $_FILES['file']['type'])[1];
                    if (!in_array($extension, array("jpeg", "jpg", "png", "gif"))) {
                        ResponseFeedback::badRequest("Формат файла не доступен. Только такие форматы возможны к выполнению: jpeg, jpg, png, gif");
                        return;
                    }
                    if ($_FILES['file']['size'] > 1024 * 1024) {
                        ResponseFeedback::badRequest("Размер файла должен быть меньше 1mb");
                        return;
                    }
                    if (!move_uploaded_file($_FILES['file']['tmp_name'], "../" . $image_path)) {
                        ResponseFeedback::internalServerError("Попробуйте еще раз, выпольнить действие!");
                        return;
                    }
                }

                $data = [
                    "username" => $_POST['username'],
                    "email" => $_POST['email'],
                    "image_path" => $image_path ?? null,
                    "message" => $_POST['message'],
                ];


                $errors = ResponseFeedback::getValidationError($data);
                if (!empty($errors)) {
                    ResponseFeedback::unprocessableEntity($errors);
                    return;
                }

                $id = $this->gateway->create($data);

                ResponseFeedback::created($id);
            } else {
                if ($this->is_admin) {
                    ResponseFeedback::methodNotAllowed(("GET, POST, PATCH"));
                    return;
                } else {
                    ResponseFeedback::methodNotAllowed("GET, POST");
                    return;
                }
            }
        } else {
            $feedback = $this->gateway->get($id);
            if ($feedback === false) {
                ResponseFeedback::notFound($id);
                return;
            }

            switch ($method) {
                case "PATCH":
                    $data = [];
                    parse_str(file_get_contents('php://input'), $data);

                    $errors = ResponseFeedback::getValidationError($data, false);
                    if (!empty($errors)) {
                        ResponseFeedback::unprocessableEntity($errors);
                        return;
                    }

                    if (!$this->is_admin) {
                        ResponseFeedback::forbidden("Для таких операций нужен доступ по уровню");
                        return;
                    }

                    $rows = $this->gateway->update($id, $data);
                    echo json_encode(["message" => "Feedback updated", "rows" => $rows]);
                    break;

                default:
                    if ($this->is_admin) {
                        ResponseFeedback::methodNotAllowed(("GET, POST, PATCH"));
                        return;
                    } else {
                        ResponseFeedback::methodNotAllowed("GET, POST");
                        return;
                    }
            }
        }
    }
}
