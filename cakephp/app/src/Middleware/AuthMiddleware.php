<?php

namespace App\Middleware;

use Cake\Network\Response;
use Cake\Network\Request;
use Cake\Routing\Router;
use Cake\Utility\Hash;
use Cake\Utility\Security;
use DateTime;
use Cake\I18n\Time;

class AuthMiddleware
{
  public function __invoke($request, $response, $next)
  {
    $session = $request->session();

    // Check if user is logged in
    if (!$session->check('Auth.User')) {
      // Redirect to login page if not logged in
      return $response->withHeader('Location', Router::url('/auth/login'))
        ->withStatus(302);
    }

    // Manage Token for One-Time Login
    $token = $session->read('Auth.Token');

    if (!$token || !$this->isValidToken($token)) {
      // Generate new token if no valid token exists
      $newToken = $this->generateToken();
      $session->write('Auth.Token', [
        'token' => $newToken,
        'expires' => (new DateTime())->modify('+1 hour')->getTimestamp()
      ]);
    }

    // Continue to the next middleware or controller
    return $next($request, $response);
  }

  private function isValidToken($token)
  {
    $expires = Hash::get($token, 'expires');
    return $expires && $expires > Time::now()->getTimestamp();
  }

  private function generateToken()
  {
    // Generate a secure random token
    return Security::hash(Security::randomBytes(32), 'sha256', true);
  }
}
