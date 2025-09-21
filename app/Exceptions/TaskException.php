<?php

namespace App\Exceptions;

use Exception;

class TaskException extends Exception
{
    protected $message;
    protected $code;

    public function __construct(string $message = 'Task operation failed', int $code = 400)
    {
        $this->message = $message;
        $this->code = $code;
        parent::__construct($message, $code);
    }

    public function render($request)
    {
        return response()->json([
            'message' => $this->message,
            'error' => 'TaskException'
        ], $this->code);
    }
}
