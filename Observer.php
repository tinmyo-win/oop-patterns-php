<?php

class Car
{
    protected $phones = []; // observer list
    protected $status;

    // public function __construct()
    // {
        
    // }

    public function attach(Phone $phone)
    {
        $this->phones[] = $phone;
    }

    public function detach(Phone $targetPhone)
    {
        $this->phones = array_filter($this->phones, function($phone) use ($targetPhone) {
            return $phone->name != $targetPhone->name;
        });
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->notify();
    }

    public function notify() {
        foreach($this->phones as $phone) {
            $phone->update();
        }
    }
}

class Phone
{
    private $car;
    public $name;

    public function __construct(Car $car, $name)
    {
        $this->name = $name;
        $this->car = $car;
        $this->car->attach($this);
    }

    public function update()
    {
        echo $this->name . " - Car is " . $this->car->getStatus() . "<br>";
    }
}

// ---

$car = new Car();
$iphone = new Phone( $car, "iPhone" );
$nexus = new Phone( $car, "Nexus" );
$mi = new Phone( $car, "Mi");

$car->setStatus("driving");
// Output:
// iPhone - Car is driving
// Nexus - Car is driving
// Mi - Car is driving

echo "----------------------------------After detaching<br>";
$car->detach($nexus);
$car->setStatus("going to the south");

// Output:
// iPhone - Car is going to the south
// Mi - Car is going to the south