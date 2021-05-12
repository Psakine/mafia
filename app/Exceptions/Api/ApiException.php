<?php

namespace App\Exceptions\Api;

use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class ApiException extends Exception
{
    /**
     * ApiException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 422, Throwable $previous = null)
    {
        $this->log($previous);
        parent::__construct($message, $code, $previous);
    }

    /**
     * Log exception
     *
     * @param Throwable|null $previous
     */
    protected function log(Throwable $previous = null)
    {
        if (!is_null($previous)) {
            $data = [
                'message' => $previous->getMessage(),
                'file' => $previous->getFile(),
                'line' => $previous->getLine()
            ];

            Log::debug(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }
    }
}
