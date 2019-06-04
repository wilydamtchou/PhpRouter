<?php
/**
 * Request class
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
 * This class is used to trait client request
 *
 */
class Request
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /**
     * The constructor method
     *
     */
    public function __construct()
    {
        $this->bootstrapSelf();
    }

    /**
     * bootstrapSelf
     * 
     * This function bootstrap the request
     *
     * @return void
     */
    private function bootstrapSelf(): void
    {
        foreach($_SERVER as $key => $value)
        {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    /**
     * toCamelCase
     * 
     * This function is used to put string in camel case
     *
     * @param string $string
     *
     * @return void
     */
    private function toCamelCase($string): string
    {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);
        foreach($matches[0] as $match)
        {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }

        return $result;
    }

    /**
     * getBody
     * 
     * This function is used to get the body of request
     *
     * @return string|null
     */
    public function getBody()
    {
        if(self::METHOD_GET === $this->requestMethod)
        {
            return;
        } elseif (self::METHOD_POST === $this->requestMethod)
        {
            $body = array();
            foreach($_POST as $key => $value)
            {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }

            return $body;
        }
    }
}
