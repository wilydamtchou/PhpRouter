<?php
/**
 * Kernel class
 *
 * (c) Grothw IT Afrimalin <willydamtchougmail.com>
 *
 * PHP version 7.2.11
 *
 * @category  class
 *
 * @package   App
 *
 * @author   Grothw IT Afrimalin <willydamtchougmail.com>
 *
 * @copyright 2019 Grothw IT Afrimalin 
 *
 * @license   Grothw IT Afrimalin 
 *
 * @link      https://my-kongossa-dev.firebaseapp.com
 */
namespace PhpRouter\App;

/**
 * This class is used to trait execute application
 *
 */
class Kernel
{
    /**
     * request
     *
     * The router will traited request
     *
     * @var \App\Router
     */
    private $router;

    /**
     * request
     *
     * The request will be traited
     *
     * @var \App\Request
     */
    private $request;

    /**
     * The constructor method
     *
     * @param \App\Request $request
     */
    public function __construct (Request $request) {
        $this->router = new Router($request);
    }

    /**
     * bootstrapingRequest
     *
     * This function bootstrap the result of request in view
     *
     * @return void
     */
    public function bootstrapingRequest(): void {
        foreach ($this->router->getGetRoutes() as $route) {
            $this->router->get($route->getPath(), $route->getCallable());
        }

        foreach ($this->router->getPostRoutes() as $route) {
            $this->router->post($route->getPath(), $route->getCallable());
        }
    }
}