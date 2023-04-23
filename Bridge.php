<?php

interface DrawingApi
{
    public function drawCircle();
    public function drawRectangle();
}

class SVGApi implements DrawingApi
{
    public function drawCircle()
    {
        echo "Drawing Circle with SVG <br>";
    }

    public function drawRectangle()
    {
        echo "Drawing Rectangle with SVG <br>";
    }
}

class CanvasApi implements DrawingApi
{
    public function drawCircle()
    {
        echo "Drawing Circle with Canvas <br>";
    }

    public function drawRectangle()
    {
        echo "Drawing Rectangle with Canvas <br>";
    }
}

abstract class Shape
{
    public $drawingApi;

    public function __construct(DrawingApi $drawingApi)
    {
        $this->drawingApi = $drawingApi;
    }

    public abstract function draw();
}

class Circle extends Shape
{
    public function draw()
    {
        $this->drawingApi->drawCircle();
    }
}

class Rectangle extends Shape
{
    public function draw()
    {
        $this->drawingApi->drawRectangle();
    }
}

$drawingApi = new CanvasApi;
$circle = new Circle($drawingApi);
$circle->draw();

$drawingApi = new SVGApi;
$rectangle = new Rectangle($drawingApi);
$rectangle->draw();
