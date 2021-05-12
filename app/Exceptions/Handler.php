<?php

namespace App\Exceptions;

use App\Exceptions\Api\ApiException;
use App\Traits\ApiJsonResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiJsonResponse;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param Throwable $exception
     * @return JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        switch (true) {
            case $exception instanceof ApiException:
                return $this->jsonResponse($exception->getMessage(), $exception->getCode());
            case $exception instanceof ValidationException:
                return $this->prepareValidationException($exception);
            default:
                return parent::render($request, $exception);
        }
    }

    /**
     * Prepare validation exception
     *
     * @param Throwable $exception
     * @return JsonResponse
     */
    protected function prepareValidationException(Throwable $exception): JsonResponse
    {
        $message = $exception->getMessage() ?? 'Validation error';
        $status = $exception->getCode() > 0 ? $exception->getCode() : 422;
        $exceptionErrors = [];

        foreach ($exception->errors() as $field => $errors) {
            $exceptionErrors[$field] = is_array($errors)
                ? current($errors)
                : $errors;
        }

        return $this->jsonResponse($message, $status, $exceptionErrors);
    }
}
