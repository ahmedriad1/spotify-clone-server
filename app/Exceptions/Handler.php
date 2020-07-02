<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // dd($exception);
        return $this->handelApiException($exception);
    }

    private function handelApiException($exception)
    {
        $data = [
            'message' => 'Server Error',
            'status' => 500
        ];
        if ($exception instanceof NotFoundHttpException) {
            $data = ['status' => 404, 'message' => 'Not found'];
        } else if ($exception instanceof AuthenticationException) {
            $data = ['status' => 401, 'message' => 'Unauthenticated'];
        } else if ($exception instanceof ModelNotFoundException) {
            $data = ['status' => 404, 'message' => 'No records'];
        } else if ($exception instanceof MethodNotAllowedHttpException) {
            $data = ['status' => 405, 'message' => 'Method not supported. Supported methods: ' . $exception->getHeaders()['Allow']];
        } else if ($exception instanceof ValidationException) {
            $data = ['status' => 422, 'message' => 'Invalid data.', 'errors' => $exception->validator->messages()->messages()];
        }
        return response()->json($data, $data['status']);
    }
}
