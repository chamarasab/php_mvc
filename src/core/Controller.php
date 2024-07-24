<?php
namespace Core;

class Controller
{
    protected function jsonResponse($data, $statusCode = 200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
    }

    protected function handleException(\Exception $e, $statusCode = 500)
    {
        error_log($e->getMessage());
        $this->jsonResponse(['message' => 'An error occurred', 'error' => $e->getMessage()], $statusCode);
    }

    protected function getInput()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        return filter_var_array($input, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}
