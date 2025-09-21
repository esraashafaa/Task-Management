<?php

namespace App\Exceptions;

use Exception;

class ProjectNotFoundException extends Exception
{
    protected $message = 'Project not found';
    protected $code = 404;

    public function __construct(string $message = 'Project not found', int $code = 404)
    {
        $this->message = $message;
        $this->code = $code;
        parent::__construct($message, $code);
    }

    public function render($request)
    {
        return response()->json([
            'message' => $this->message,
            'error' => 'ProjectNotFoundException'
        ], $this->code);
    }
}
