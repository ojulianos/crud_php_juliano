<?php

namespace Core;

class BaseController {

    protected function view($page = 'index', $data = [])
    {
        extract($data);

        require_once APP . 'Views/_templates/header.phtml';
        require_once APP . "Views/{$page}.phtml";
        require_once APP . 'Views/_templates/footer.phtml';
    }


    protected function success($message)
    {
        $this->show_json_message($message, true);
    }

    protected function error($message)
    {
        $this->show_json_message($message, false);
    }

    private function show_json_message($message, $success = true)
    {
        header('Content-type: application/json');
        !$success ? http_response_code(500) : http_response_code(200);

        echo json_encode([
            'success' => $success,
            'message' => $message,
        ]);
    }
}