<?php

class CarOptions
{
    var $color = "White";
    var $doors = 4;
}

class Car
{
    private $color;
    private $doors;

    public function __construct(CarOptions $options)
    {
        $this->color = $options->color;
        $this->doors = $options->doors;
    }

    public function info()
    {
        return "This is a $this->doors doors $this->color car.<br>";
    }
}

class Lamborghini extends Car
{
  public function info()
  {
    $carInfo = parent::info();
    return $carInfo . "But it is Lambo!!!! 🏎️<br>";

  }
}

class CarFactory
{
    private $options;

    public function __construct($color, $doors)
    {
        $options = new CarOptions();
        $options->color = $color;
        $options->doors = $doors;

        $this->options = $options;
    }

    public function build(string $carType = "")
    {
      if($carType == "Lamborghini") {
        return new Lamborghini($this->options);
      }

      return new Car($this->options);
    }
}

// ---

$factory = new CarFactory("Red", 2);
$lambo = $factory->build("Lamborghini");
echo $lambo->info();

echo "--------------------------<br>";

$car = $factory->build();
echo $car->info();
// Output: This is a 2 doors Red car.
