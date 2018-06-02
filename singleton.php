<?php

/**
 *  Singleton
 *
 * Garente que uma classe tenha apenas um instância e fornece um ponto global de acesso a ela.
 */


final class App
{

    static private $instance;
    
    private function __construct(){}

    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}

$app = App::getInstance();
$app2 = App::getInstance();

var_dump($app == $app2);