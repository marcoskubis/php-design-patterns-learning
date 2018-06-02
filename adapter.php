<?php

/**
 * Adapter
 *
 * Converter a interface de um classe para outra interface que o cliente espera econtrar.
 * O adaptador permite que classes com interfaces incompatíveis trabalhem juntas.
 */

abstract class Duck {
    abstract public function quack();
    abstract public function fly();
}

abstract class Turkey {
    abstract public function gobble();
    abstract public function fly();
}

class MallardDuck extends Duck {
    public function quack()
    {
        echo "Quack!" . PHP_EOL;
    }

    public function fly()
    {
        echo "I'm flying!" . PHP_EOL;
    }
}

class WildTurkey extends Turkey {
    public function gobble()
    {
        echo "Gobble gobble!" . PHP_EOL;
    }

    public function fly()
    {
        echo "I'm flying a short distance!" . PHP_EOL;
    }
}

class TurkeyAdapter extends Duck {
    protected $turkey;

    public function __construct(Turkey $turkey)
    {
        $this->turkey = $turkey;
    }

    public function quack()
    {
        $this->turkey->gobble();
    }

    public function fly()
    {
        for ($i=0; $i < 5; $i++) { 
            $this->turkey->fly();
        }
    }
}

$duck = new MallardDuck;

testDuck($duck);

$turkey = new TurkeyAdapter(new WildTurkey);

testDuck($turkey);

function testDuck(Duck $duck)
{
    echo "------------------- Testing duck -------------------" . PHP_EOL;
    $duck->quack();
    $duck->fly();
}