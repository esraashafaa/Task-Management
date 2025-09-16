<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $exception, Request $request) {
            if (! $request->expectsJson()) {
                return null;
            }

            if ($exception instanceof ValidationException) {
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $exception->errors(),
                ], 422);
            }

            if ($exception instanceof AccessDeniedHttpException) {
                return response()->json([
                    'message' => $exception->getMessage() ?? 'You are not authorized to perform this action.',
                ], 403);
            }

            if ($exception instanceof AuthorizationException) {
                return response()->json([
                    'message' => $exception->getMessage() ?? 'You are not authorized to perform this action.',
                ], 403);
            }

            if ($exception instanceof AuthenticationException) {
                return response()->json([
                    'message' => $exception->getMessage() ?? 'Unauthenticated.',
                ], 401);
            }

            if ($exception instanceof ModelNotFoundException) {
                $modelName = class_basename($exception->getModel());
                return response()->json([
                    'message' => $exception->getMessage() ?? "{$modelName} not found.",
                ], 404);
            }

            if ($exception instanceof NotFoundHttpException) {
                return response()->json([
                    'message' => $exception->getMessage() ?? 'Route not found.',
                ], 404);
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json([
                    'message' => $exception->getMessage() ?? 'HTTP method not allowed.',
                ], 405);
            }

            if ($exception instanceof BadRequestHttpException) {
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 400);
            }

            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => config('app.debug') ? $exception->getMessage() : null,
            ], 500);
        });
    })->create();
