<?php

/**
 * Template Method
 *
 * Define o esqueleto de um algoritimo dentro de um método, transferindo alguns de seus
 * passos para as subclasses. O template method permite que as subclasses redefinam certos
 * passos de algoritimo sem alterar a estrutura do própro algoritimo.
 */

abstract class CaffeineBeverage {
    final public function prepareRecipe() {
        $this->boilWater();
        $this->brew();
        $this->pourInCup();
        if ($this->customerWantsCondiments()) {
            $this->addCondiments();
        }
    }

    public function boilWater()
    {
        echo "Boiling water" . PHP_EOL;
    }

    public function pourInCup()
    {
        echo "Pouring into cup" . PHP_EOL;
    }

    abstract public function brew();
    abstract public function addCondiments();

    public function customerWantsCondiments(): Bool
    {
        return true;
    }
}

class Tea extends CaffeineBeverage {
    public function brew()
    {
        echo "Steeping the tea" . PHP_EOL;
    }

    public function addCondiments()
    {
        echo "Adding lemon" . PHP_EOL;
    }
}

class Coffe extends CaffeineBeverage {
    public function brew()
    {
        echo "Dripping coffe through filter" . PHP_EOL;
    }

    public function addCondiments()
    {
        echo "Adding sugar and milk" . PHP_EOL;
    }

    public function customerWantsCondiments(): Bool
    {
        $answer = $this->getUserInput();
        if (substr(strtolower($answer), 0, 1) === "y") {
            return true;
        }
        return false;
    }

    protected function getUserInput()
    {
        $answer = readline("Would you like milk and sugar with your coffe (y/n)? ");
        if (!$answer) {
            $answer = "no";
        }
        return $answer;
    }
}

$coffe = new Coffe;
$coffe->prepareRecipe();

$tea = new Tea;
$tea->prepareRecipe();