<?php
/**
 * Router class
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
 * This class is used to trait client urls
 *
 */
class Router
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /**
     * request
     *
     * The request will be traited
     *
     * @var \App\Request
     */
    private $request;

    /**
     * supportedHttpMethods
     *
     * The supported methods of our site
     *
     * @var array
     */
    private $supportedHttpMethods = ['GET', 'POST'];

    /**
     * sroutes
     *
     * The routes of project
     *
     * @var array
     */
    private $routes;

    /**
     * The constructor method
     *
     * @param \App\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->routes = [
            'GET' => [
                new Route ('/upload', '\PhpRouter\Services\UploadService::upload'),
                new Route ('/', '\PhpRouter\Services\DefaultService::index'),
            ],
            'POST' => [
            ]
        ];
    }

    /**
     * The call method
     *
     * @param string $name
     * @param array  $args
     */
    public function __call(string $name, array $args)
    {
        list($route, $method) = $args;
        if(!in_array(strtoupper($name), $this->supportedHttpMethods))
        {
            $this->invalidMethodHandler();
        }
        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    /**
     * The destruct method
     *
     */
    public function __destruct()
    {
        $this->resolve();
    }

    /**
     * formatRoute
     *
     * Removes trailing forward slashes from the right of the route.
     *
     * @param string route
     *
     * @return string
     */
    private function formatRoute(string $route): string
    {
        $result = rtrim($route, '/');
        if ($result === '')
        {
            return '/';
        }

        return $result;
    }

    /**
     * invalidMethodHandler
     *
     * Return invalid message when method not correct
     *
     * @return void
     */
    private function invalidMethodHandler(): void
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    /**
     * defaultRequestHandler
     *
     * Return default page when url not found
     *
     * @return void
     */
    private function defaultRequestHandler(): void
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    /**
     * resolve
     *
     * Resolves a route
     *
     * @return void
     */
    public function resolve(): void
    {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $formatedRoute = $this->formatRoute($this->request->requestUri);
        $method = $methodDictionary[$formatedRoute];
        if(is_null($method))
        {
            $this->defaultRequestHandler();

            return;
        }
        echo call_user_func_array($method, array($this->request));
    }

    /**
     * getGetRoutes
     *
     * This function return get routes
     *
     * @return array
     */
    public function getGetRoutes(): array {
        return $this->routes[self::METHOD_GET];
    }

    /**
     * getPostRoutes
     *
     * This function return post routes
     *
     * @return array
     */
    public function getPostRoutes(): array {
        return $this->routes[self::METHOD_POST];
    }
}

