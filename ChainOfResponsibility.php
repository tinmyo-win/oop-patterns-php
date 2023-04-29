<?php

abstract class PurchasePower
{
    const BASE = 10;

    public $successor;

    abstract function handleRequest(Command $command);

    public function getSuccessor()
    {
        return $this->successor;
    }

    public function setSuccessor(PurchasePower $successor)
    {
        $this->successor = $successor;
    }
}

class ManagerPower extends PurchasePower
{

    private $allow = PurchasePower::BASE * 10;

    public function handleRequest(Command $command)
    {
        if ($command->amount <= $this->allow) {
            echo ("Sale handled by Manager<br>");
        } else {
            if ($this->getSuccessor() != null) {
                $this->successor->handleRequest($command);
            }
        }
    }
}

class DirectorPower extends PurchasePower
{

    private $allow = PurchasePower::BASE * 20;

    public function handleRequest(Command $command)
    {
        if ($command->amount <= $this->allow) {
            echo ("Sales handled by Director<br>");
        } else {
            if ($this->getSuccessor() != null) {
                $this->successor->handleRequest($command);
            }
        }
    }
}

class VicePresident extends PurchasePower
{

    private $allow = PurchasePower::BASE * 100;

    public function handleRequest(Command $command)
    {
        if ($command->amount <= $this->allow) {
            echo ("Sales handled by Vice President<br>");
        } else {
            echo "I can't handle this many sales as a vice president. But let me check <br>";
        }
    }
}

class Command
{
    public $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }
}

class CorDemo {
        
    public function __construct()
    {
        $manager = new ManagerPower();
        $director = new DirectorPower();
        $vice = new VicePresident();
        
        $manager->setSuccessor($director);
        $director->setSuccessor($vice);
        $command = new Command(10);
        
        $manager->handleRequest($command);
        $manager->handleRequest(new Command(1020));
        $manager->handleRequest(new Command(200));
        $manager->handleRequest(new Command(600));
    }
}

$demo = new CorDemo;
