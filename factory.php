<?php

/**
 * Factory method
 *
 * O padrão factory mathod define uma interface para criar um objeto, mas permite as
 * classes decidir qual classe instanciar. O factory method permite a uma classe deferir
 * a instanciação para subclasses.
 *
 * Abstract Factory
 *
 * Fornece uma interface para criar famílias de objetos relacionados ou dependentes sem
 * especificar suas classes concretas.
 */

abstract class PizzaStore {
    public function orderPizza(String $type)
    {
        $pizza = $this->createPizza($type);
        $pizza->prepare();
        $pizza->bake();
        $pizza->cut();
        $pizza->box();
        return $pizza;
    }

    abstract public function createPizza(String $type): Pizza;
}

abstract class Pizza {
    protected $name;
    protected $dough;
    protected $souce;
    protected $veggies = [];
    protected $cheese;
    protected $pepperoni;
    protected $clam;

    abstract public function prepare(): void;

    public function bake(): void
    {
        echo "Bake for 25 minutes at 350 degrees" . PHP_EOL;
    }

    public function cut(): void
    {
        echo "Cutting the pizza into diagonal slices" . PHP_EOL;
    }

    public function box(): void
    {
        echo "Place pizza in a official PizzaStore box" . PHP_EOL;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->getName() . PHP_EOL;
    }
}

interface PizzaIngredientFactory {
    public function createDough(): Dough;
    public function createSouce(): Souce;
    public function createCheese(): Cheese;
    public function createVeggies(): Array;
    public function createPepperoni(): Pepperoni;
    public function createClam(): Clam;
}

interface Dough {}
interface Souce {}
interface Cheese {}
interface Veggie {}
interface Pepperoni {}
interface Clam {}

class ThinCrustDough implements Dough {}
class MarinaraSouce implements Souce {}
class ReggianoCheese implements Cheese {}
class Garlic implements Veggie {}
class Onion implements Veggie {}
class SlicedPepperoni implements Pepperoni {}
class FreshClam implements Clam {}

class NyPizzaIngredientFactory implements PizzaIngredientFactory {

    public function createDough(): Dough
    {
        return new ThinCrustDough;
    }

    public function createSouce(): Souce
    {
        return new MarinaraSouce;
    }

    public function createCheese(): Cheese
    {
        return new ReggianoCheese;
    }

    public function createVeggies(): Array
    {
        return [new Garlic, new Onion];
    }

    public function createPepperoni(): Pepperoni
    {
        return new SlicedPepperoni;
    }

    public function createClam(): Clam
    {
        return new FreshClam;
    }
}

class ChicagoPizzaIngredientFactory implements PizzaIngredientFactory {

    public function createDough(): Dough
    {
        return new ThinCrustDough;
    }

    public function createSouce(): Souce
    {
        return new MarinaraSouce;
    }

    public function createCheese(): Cheese
    {
        return new ReggianoCheese;
    }

    public function createVeggies(): Array
    {
        return [new Garlic, new Onion];
    }

    public function createPepperoni(): Pepperoni
    {
        return new SlicedPepperoni;
    }

    public function createClam(): Clam
    {
        return new FreshClam;
    }
}

class CheesePizza extends Pizza {
    protected $ingredientfactory;

    public function __construct(PizzaIngredientFactory $ingredientfactory)
    {
        $this->ingredientfactory = $ingredientfactory;
    }

    public function prepare(): void
    {
        echo "Preparing " . $this->name . PHP_EOL;
        $this->dough = $this->ingredientfactory->createDough();
        $this->souce = $this->ingredientfactory->createSouce();
        $this->cheese = $this->ingredientfactory->createCheese();
    }
}

class ClamPizza extends Pizza {
    protected $ingredientfactory;

    public function __construct(PizzaIngredientFactory $ingredientfactory)
    {
        $this->ingredientfactory = $ingredientfactory;
    }

    public function prepare(): void
    {
        echo "Preparing " . $this->name . PHP_EOL;
        $this->dough = $this->ingredientfactory->createDough();
        $this->souce = $this->ingredientfactory->createSouce();
        $this->cheese = $this->ingredientfactory->createCheese();
        $this->clam = $this->ingredientfactory->createClam();
    }
}

class NYPizzaStore extends PizzaStore {

    public function createPizza(String $type): Pizza
    {
        $pizza = null;
        $ingredientfactory = new NyPizzaIngredientFactory;
        if ($type == "cheese") {
            $pizza = new CheesePizza($ingredientfactory);
            $pizza->setName("New York Cheese Pizza");
        }else if ($type == "clam") {
            $pizza = new ClamPizza($ingredientfactory);
            $pizza->setName("New York Clam Pizza");
        }
        return $pizza;
    }
}

class ChicagoPizzaStore extends PizzaStore {
    public function createPizza(String $type): Pizza
    {
        $pizza = null;
        $ingredientfactory = new ChicagoPizzaIngredientFactory;
        if ($type == "cheese") {
            $pizza = new CheesePizza($ingredientfactory);
            $pizza->setName("Chicago Cheese Pizza");
        }else if ($type == "clam") {
            $pizza = new ClamPizza($ingredientfactory);
            $pizza->setName("Chicago Clam Pizza");
        }
        return $pizza;
    }
}

$store = new NYPizzaStore;
$store->orderPizza("cheese");

$store = new ChicagoPizzaStore;
$cheesePizza = $store->orderPizza("cheese");
$clamPizza = $store->orderPizza("clam");
echo $clamPizza;