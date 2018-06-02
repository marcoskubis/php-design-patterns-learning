<?php

/**
 * Facade
 *
 * Fornece uma interface unificada para um conjunto de interfaces em um subsistema.
 * A fachada define uma interface de nível mais alto que facilida a utilização
 * do subsistema.
 */

class DependencyOne {
    public function method() {
        echo "DependencyOne method called" . PHP_EOL;
    }
}

class DependencyTwo {
    public function method() {
        echo "DependencyTwo method called" . PHP_EOL;
    }
}

class DependencyThree {
    public function method() {
        echo "DependencyThree method called" . PHP_EOL;
    }
}

class Facade {
    protected $depOne;
    protected $depTwo;
    protected $depThree;

    public function __construct(DependencyOne $depOne, DependencyTwo $depTwo, DependencyThree $depThree)
    {
        $this->depOne = $depOne;
        $this->depTwo = $depTwo;
        $this->depThree = $depThree;
    }

    public function simplifiedMethod()
    {
        $this->depOne->method();
        $this->depTwo->method();
        $this->depThree->method();
    }
}

$depOne = new DependencyOne;
$depTwo = new DependencyTwo;
$depThree = new DependencyThree;

$facade = new Facade($depOne, $depTwo, $depThree);
$facade->simplifiedMethod();