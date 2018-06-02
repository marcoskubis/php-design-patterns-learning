<?php

/**
 * Command
 *
 * Encapsula uma solicitação como um objeto, o que lhe permite parametrizar outros objetos 
 * com diferentes solicitações, enfileirar ou registrar solicitações e implementar recursos 
 * de cancelamento de operações.
 */

interface Command {
    public function execute(): void;
    public function undo(): void;
}

class Light {
    public function on()
    {
        echo "Light is on" . PHP_EOL;
    }

    public function off()
    {
        echo "Light is off" . PHP_EOL;
    }
}

class GarageDoor {
    public function up()
    {
        echo "Garage Door is Open" . PHP_EOL;
    }

    public function down()
    {
        echo "Garage Door is Closed" . PHP_EOL;
    }
}

class LightOnCommand implements Command {

    protected $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute(): void
    {
        $this->light->on();
    }

    public function undo(): void
    {
        $this->light->off();
    }
}

class LightOffCommand implements Command {

    protected $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute(): void
    {
        $this->light->off();
    }

    public function undo(): void
    {
        $this->light->on();
    }
}

class GarageDoorOpenCommand implements Command{

    protected $garageDoor;

    public function __construct(GarageDoor $garageDoor)
    {
        $this->garageDoor = $garageDoor;
    }

    public function execute(): void
    {
        $this->garageDoor->up();
    }

    public function undo(): void
    {
        $this->garageDoor->down();
    }
}

class GarageDoorCloseCommand implements Command{

    protected $garageDoor;

    public function __construct(GarageDoor $garageDoor)
    {
        $this->garageDoor = $garageDoor;
    }

    public function execute(): void
    {
        $this->garageDoor->down();
    }

    public function undo(): void
    {
        $this->garageDoor->up();
    }
}

class NoCommand implements Command {
    public function execute(): void {
        echo "Nothing happened" . PHP_EOL;
    }

    public function undo(): void {
        echo "Nothing happened" . PHP_EOL;
    }
}

class SimpleRemoteControl {
    
    protected $onCommands = [];
    protected $offCommands = [];
    protected $undoCommand;

    public function __construct()
    {
        $noCommand = new NoCommand;
        for ($i=0; $i < 7; $i++) { 
            $this->onCommands[$i] = $noCommand;
            $this->offCommands[$i] = $noCommand;
        }
        $this->undoCommand = $noCommand;
    }

    public function setCommand(Int $slot, Command $onCommand, Command $offCommand)
    {
        $this->onCommands[$slot] = $onCommand;
        $this->offCommands[$slot] = $offCommand;
    }

    public function onButtonWasPressed(Int $slot)
    {
        $this->onCommands[$slot]->execute();
        $this->undoCommand = $this->onCommands[$slot];
    }

    public function offButtonWasPressed(Int $slot)
    {
        $this->offCommands[$slot]->execute();
        $this->undoCommand = $this->offCommands[$slot];
    }

    public function undoButtonWasPressed()
    {
        $this->undoCommand->undo();
    }

    public function __toString()
    {
        $string = "\n-------------------- REMOTE ---------------------\n";
        foreach ($this->onCommands as $i => $onCommand) {
            $offCommand = $this->offCommands[$i];
            $string .= "[slot {$i}] " . get_class($onCommand) . " " . get_class($offCommand) . PHP_EOL;
        }
        $string .= "[undo] " . get_class($this->undoCommand) . PHP_EOL;
        return $string;
    }
}

$remote = new SimpleRemoteControl;

$lightOn = new LightOnCommand(new Light);
$lightOff = new LightOffCommand(new Light);
$garageDoorOpen = new GarageDoorOpenCommand(new GarageDoor);
$garageDoorClose = new GarageDoorCloseCommand(new GarageDoor);

$remote->setCommand(0, $lightOn, $lightOff);
$remote->setCommand(1, $garageDoorOpen, $garageDoorClose);

$remote->onButtonWasPressed(0);
$remote->offButtonWasPressed(0);
$remote->undoButtonWasPressed();

$remote->onButtonWasPressed(1);
$remote->offButtonWasPressed(1);

$remote->undoButtonWasPressed();

echo $remote;