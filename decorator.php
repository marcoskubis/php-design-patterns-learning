<?php

/**
 * Decorator
 *
 * Anexa responsabilidades adicionais a um objeto dinamicamente. Os decoradores fornecem
 * uma alternativa flexivel de subclasse para extender a funcionalidade.
 */

abstract class Beverage {
    protected $description = "Unknown Beverage";

    abstract public function cost(): Float;

    public function getDescription(): String {
        return $this->description;
    }
}

abstract class CondimentDecorator extends Beverage {
    
}

class Expresso extends Beverage {
    public function __construct()
    {
        $this->description = "Expresso";
    }

    public function cost(): Float
    {
        return 1.99;
    }
}

class HouseBlend extends Beverage {
    public function __construct()
    {
        $this->description = "House Blend Coffe";
    }

    public function cost(): Float
    {
        return .89;
    }
}

class Mocha extends CondimentDecorator {
    protected $beverage;

    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    public function getDescription(): String
    {
        return sprintf("%s, %s", $this->beverage->getDescription(), "Mocha");
    }

    public function cost(): Float
    {
        return .20 + $this->beverage->cost();
    }
}

class Soy extends CondimentDecorator {
    protected $beverage;

    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    public function getDescription(): String
    {
        return sprintf("%s, %s", $this->beverage->getDescription(), "Soy");
    }

    public function cost(): Float
    {
        return .15 + $this->beverage->cost();
    }
}

$expresso = new Expresso;
$expresso = new Mocha($expresso);
$expresso = new Soy($expresso);
echo "Name: " . $expresso->getDescription() . PHP_EOL;
echo "Price: " . $expresso->cost() . PHP_EOL;