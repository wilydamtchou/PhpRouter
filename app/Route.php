<?php
/**
 * Route class
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
 * This class is used to represent route
 *
 */
class Route
{
    /**
     * path
     *
     * The path of the route
     *
     * @var string
     */
    private $path;

     /**
     * callable
     *
     * The callable will be traited
     *
     * @var callable
     */
    private $callable;

    /**
     * The constructor method
     *
     * @param string   $path
     * @param string $callable
     */
    public function __construct(string $path, string $callable)
    {
        $this->path = $path;
        $this->callable = \Closure::fromCallable($callable);
    }

     /**
     * Get path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Get callable
     *
     * @return callable
     */
    public function getCallable(): callable
    {
        return $this->callable;
    }
}