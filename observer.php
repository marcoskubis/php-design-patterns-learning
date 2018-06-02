<?php

/**
 * Observer
 *
 * Define a dependência UM para MUITOS entre objetos para que quando um objeto mude de estado
 * todos os seus dependentes sejam avisados e atualizados automaticamente.
 */

interface Subject {
    public function register(Observer $o);
    public function remove(Observer $o);
    public function notify();
}

interface Observer {
    public function update(Float $temp, Float $humidity, Float $pressure);
}

interface DisplayElement {
    public function display();
}

class WeatherData implements Subject{
    private $observers;
    private $temperature;
    private $humidity;
    private $pressure;

    public function __construct()
    {
        $this->observers = [];
    }

    public function register(Observer $observer)
    {
        array_push($this->observers, $observer);
    }

    public function remove(Observer $observer)
    {
        $index = array_search($observer, $this->observers);
        unset($this->observers[$index]);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->temperature, $this->humidity, $this->pressure);
        }
    }

    public function measurementsChanged()
    {
        $this->notify();
    }

    public function setMeasurements(Float $temperature, Float $humidity, Float $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->measurementsChanged();
    }
}

class CurrentConditionsDisplay implements Observer, DisplayElement {
    private $temperature;
    private $humidity;
    private $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
        $this->subject->register($this);
    }

    public function update(Float $temp, Float $humidity, Float $pressure)
    {
        $this->temperature = $temp;
        $this->humidity = $humidity;
        $this->display();
    }

    public function display()
    {
        echo "Current conditions: {$this->temperature}F degrees and {$this->humidity}% humidity" . PHP_EOL;
    }
}

$weatherData = new WeatherData;
$display = new CurrentConditionsDisplay($weatherData);

$weatherData->setMeasurements(80, 65, 30.4);
$weatherData->remove($display);
$weatherData->setMeasurements(82, 62, 28.4);
$weatherData->setMeasurements(82, 62, 28.4);
$weatherData->register($display);
$weatherData->setMeasurements(83, 62, 28.4);