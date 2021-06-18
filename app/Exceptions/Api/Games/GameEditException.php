<?php

namespace App\Exceptions\Api\Games;

use App\Exceptions\Api\ApiException;
use Throwable;

class GameEditException extends ApiException
{
    /**
     * Construct the exception.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 422, Throwable $previous = null)
    {
        if (empty($message)) {
            $message = 'Filed to edit game';
        }

        parent::__construct($message, $code, $previous);
    }
}
