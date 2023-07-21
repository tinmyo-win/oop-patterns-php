<?php

interface CarService
{
    public function getCost();

    public function getDescrtiption();
}

class BasicInspection implements CarService
{
    public function getCost()
    {
        return 25;
    }

    public function getDescrtiption()
    {
        return "Basci Inspection";
    }
}

class OilChange implements CarService
{
    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }
    public function getCost()
    {
        return $this->carService->getCost() + 19;
    }

    public function getDescrtiption()
    {
        return $this->carService->getDescrtiption() . " and oil change";
    }
}

class TyreRotation implements CarService
{
    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }
    public function getCost()
    {
        return $this->carService->getCost() + 10;
    }

    public function getDescrtiption()
    {
        return $this->carService->getDescrtiption() . " and tyre rotate";
    }
}

$service = new TyreRotation(new OilChange(new BasicInspection));

var_dump($service->getDescrtiption());
var_dump($service->getCost());