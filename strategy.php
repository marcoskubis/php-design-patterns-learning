<?php

/**
 * Strategy
 *
 * Define uma famíla de algorítimos, encapsula cada um deles e os torna intercambiáveis.
 * A estratégia deixa o algorítimo variar independentemente dos clientes que o utilizam.
 */

abstract class Duck {
    protected $flyBehavior;
    protected $quackBehavior;

    abstract public function display();

    public function performFly()
    {
        $this->flyBehavior->fly();
    }

    public function performQuack()
    {
        $this->quackBehavior->quack();
    }

    public function setFlyBehavior(FlyBehavior $flyBehavior)
    {
        $this->flyBehavior = $flyBehavior;
    }

    public function setQuackBehavior(QuackBehavior $quackBehavior)
    {
        $this->quackBehavior = $quackBehavior;
    }
}

interface FlyBehavior {
    public function fly();
}

interface QuackBehavior {
    public function quack();
}

class FlyWithWings implements FlyBehavior {
    public function fly()
    {
        echo "I'm flying!" . PHP_EOL;
    }
}

class FlyNoWay implements FlyBehavior {
    public function fly()
    {
        echo "I can't fly!" . PHP_EOL;
    }
}

class FlyRocketPowered implements FlyBehavior {
    public function fly()
    {
        echo "I'm flying with a rocket'!" . PHP_EOL;
    }
}

class Quack implements QuackBehavior {
    
    public function __construct() {}

    public function quack()
    {
        echo "Quack!" . PHP_EOL;
    }
}

final class MallardDuck extends Duck {

    public function __construct()
    {
        $this->flyBehavior = new FlyWithWings;
        $this->quackBehavior = new Quack;
    }

    public function display()
    {
        echo "A pretty mallard duck!" . PHP_EOL;
    }
}

class ModelDuck extends Duck {
    public function __construct()
    {
        $this->flyBehavior = new FlyNoWay;
        $this->quackBehavior = new Quack;
    }

    public function display()
    {
        echo "A basic model duck!" . PHP_EOL;
    }
}

class FakeDuck {

    protected $quackBehavior;

    public function setQuackBehavior(QuackBehavior $quackBehavior)
    {
        $this->quackBehavior = $quackBehavior;
    }

    public function performQuack()
    {
        $this->quackBehavior->quack();
    }
}

$duck = new MallardDuck();
$duck->performFly();
$duck->performQuack();

$model = new ModelDuck();
$model->performFly();
$model->setFlyBehavior(new FlyRocketPowered);
$model->performFly();

$fake = new FakeDuck();
$fake->setQuackBehavior(new Quack);
$fake->performQuack();