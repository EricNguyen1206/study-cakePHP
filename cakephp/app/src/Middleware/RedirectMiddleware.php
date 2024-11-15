<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Cake\Http\Response;
use Cake\Routing\Router;
class RedirectMiddleware
{
  public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
  {
    // Check if the request URI is the root path `/`
    if ($request->getUri()->getPath() === '/') {
      // Generate the URL for /notes
      $notesUrl = Router::url(['controller' => 'Notes', 'action' => 'index'], true);

      // Redirect to /notes
      return $response
        ->withHeader('Location', $notesUrl)
        ->withStatus(302); // 302 Found status for redirection
    }

    // If not root, proceed to the next middleware
    return $next($request, $response);
  }
}
