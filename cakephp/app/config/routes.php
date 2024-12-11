<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true,
    ]));

    /*
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered through `Application::routes()` with `registerMiddleware()`
     */
    $routes->applyMiddleware('csrf');

    /*
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    $routes->connect('/notes', ['controller' => 'Notes', 'action' => 'index']);

    $routes->connect(
        '/notes/edit/:id',
        ['controller' => 'Notes', 'action' => 'edit'],
        ['pass' => ['id'], 'id' => '\d+']
    );

    $routes->connect(
        '/notes/delete/:id',
        ['controller' => 'Notes', 'action' => 'delete'],
        ['pass' => ['id'], 'id' => '\d+']
    );

    $routes->scope('/projects', function ($routes) {
        $routes->connect('/', ['controller' => 'Projects', 'action' => 'index']);
        $routes->connect('/add', ['controller' => 'Projects', 'action' => 'add']);
        $routes->connect('/edit/:id', ['controller' => 'Projects', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect('/delete/:id', ['controller' => 'Projects', 'action' => 'delete'], ['pass' => ['id']]);
    });

    $routes->scope('/user-project-roles', function ($routes) {
        $routes->connect('/', ['controller' => 'UserProjectRoles', 'action' => 'index']);
        $routes->connect('/add', ['controller' => 'UserProjectRoles', 'action' => 'add']);
        $routes->connect('/delete/:id', ['controller' => 'UserProjectRoles', 'action' => 'delete'], ['pass' => ['id']]);
    });

    $routes->scope('/posts', function ($routes) {
        $routes->connect('/', ['controller' => 'Posts', 'action' => 'index']);
        $routes->connect('/add', ['controller' => 'Posts', 'action' => 'add']);
        $routes->connect('/delete/:id', ['controller' => 'Posts', 'action' => 'delete'], ['pass' => ['id']]);
    });

    $routes->scope('/votes', function ($routes) {
        $routes->connect('/add', ['controller' => 'Votes', 'action' => 'add']);
        $routes->connect('/delete/:id', ['controller' => 'Votes', 'action' => 'delete'], ['pass' => ['id']]);
    });

    $routes->fallbacks(DashedRoute::class);
});
