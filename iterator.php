<?php

interface Menu {
    public function createIterator(): Iterator;
}

class MenuItem {
    protected $name;
    protected $description;
    protected $vegetarian;
    protected $price;

    public function __construct(String $name, String $description, Bool $vegetarian, Float $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->vegetarian = $vegetarian;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function isVegetarian()
    {
        return $this->vegetarian;
    }
}

class PancakeHouseMenu implements Menu {
    protected $menuItems = [];

    public function __construct()
    {
        $this->addItem("Pancake A", "Description for pancake A", true, 2.99);
        $this->addItem("Pancake B", "Description for pancake B", false, 1.99);
        $this->addItem("Pancake C", "Description for pancake C", false, 4.99);
    }

    public function addItem(String $name, String $description, Bool $vegetarian, Float $price)
    {
        $this->menuItems[] = new MenuItem($name, $description, $vegetarian, $price);
    }

    public function createIterator(): Iterator
    {
        return new PancakeHouseMenuIterator($this->menuItems);
    }
}

class DinerMenu implements Menu {
    protected $menuItems;

    public function __construct()
    {
        $this->menuItems = new ArrayIterator([]);
        $this->addItem("Lunch A", "Description for lunch A", false, 10.99);
        $this->addItem("Lunch B", "Description for lunch B", false, 8.99);
        $this->addItem("Lunch C", "Description for lunch C", true, 7.99);
    }

    public function addItem(String $name, String $description, Bool $vegetarian, Float $price)
    {
        $menuItem = new MenuItem($name, $description, $vegetarian, $price);
        $this->menuItems->append($menuItem);
    }

    public function createIterator(): Iterator
    {
        return $this->menuItems;
    }
}

class PancakeHouseMenuIterator implements Iterator {

    protected $menuItems;
    protected $position = 0;

    public function __construct(Array $menuItems)
    {
        $this->menuItems = $menuItems;
        $this->position = 0;
    }

    public function current () {
        return $this->menuItems[$this->position];
    }

    public function key () {
        return $this->position;
    }

    public function next () {
        $this->position++;
    }

    public function rewind () {
        $this->position = 0;
    }

    public function valid () {
        return isset($this->menuItems[$this->position]);
    }
}

class Waitress {
    protected $pancakeMenu;
    protected $dinerMenu;

    public function __construct(Menu $pancakeMenu, Menu $dinerMenu)
    {
        $this->pancakeMenu = $pancakeMenu;
        $this->dinerMenu = $dinerMenu;
    }

    public function printAllMenus()
    {
        $pancakeIterator = $this->pancakeMenu->createIterator();
        $dinerIterator = $this->dinerMenu->createIterator();
        echo "---------- MENU ----------" . PHP_EOL;
        echo "--- PANCAKE MENU ---------" . PHP_EOL;
        $this->printMenu($pancakeIterator);
        echo "--- DINER MENU -----------" . PHP_EOL;
        $this->printMenu($dinerIterator);
    }

    private function printMenu(Iterator $iterator) {
        foreach ($iterator as $key => $item) {
            echo "{$item->getName()}, {$item->getPrice()} -- {$item->getDescription()}" . PHP_EOL;
        }
    }
}

$pancakeMenu = new PancakeHouseMenu;
$dinerMenu = new DinerMenu;

$waitress = new Waitress($pancakeMenu, $dinerMenu);

$waitress->printAllMenus();