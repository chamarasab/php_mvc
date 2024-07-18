<?php

namespace Middlewares;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        // Implement authentication logic
        if (!$this->isAuthenticated($request)) {
            http_response_code(401);
            echo 'Unauthorized';
            return;
        }

        return $next($request);
    }

    private function isAuthenticated($request)
    {
        // Check if the request is authenticated
        // For simplicity, we're returning true here. Implement your authentication logic.
        return true; // Implement your authentication logic here
    }
}
?>
