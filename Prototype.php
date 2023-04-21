<?php

class Robot
{
    public $name = "Sophia";
    public $size = "medium";
    public $weight = "Lightweight";
    public $power_source = "Battery";
    public $actuators = "Motor";
    public $os = "ROS";

    // This magic method automatically invoke when attempting
    // to copy instance (object) of this class with `clone`
    public function __clone()
    {
        echo "Cloning Robot...<br>";
    }
}

// ---

$robot = new Robot();

// Creating new object by cloning
$robot2 = clone $robot;
?>

<pre>
<?php
print_r($robot2);
?>
</pr>