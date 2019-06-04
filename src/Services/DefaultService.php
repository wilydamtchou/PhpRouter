<?php
/**
 * Default Service
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
namespace PhpRouter\Services;

/**
 * This class is used to trait default actions
 *
 */
class DefaultService
{
    /**
     * index
     *
     * This function is used to return index page
     *
     * @return string
     */
    public static function index(): string
    {
        return 'Welcome MK Cloud';
    }
}