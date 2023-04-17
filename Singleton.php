<?php

class Setting
{
    protected static $setting = null;
    public $info = "";
    protected $switch = false;

    protected function __construct()
    {
        $this->info = "I am a single. <br>";
    }

    static function make()
    {
        if (!static::$setting) {
            static::$setting = new static;
        }

        return static::$setting;
    }

    function status()
    {
        return 'Setting is ' . ($this->switch ? 'enabled' : 'disabled') . '<br>';
    }

    function toggleStatus()
    {
        $this->switch = !$this->switch;
    }
}

// ---

$setting = Setting::make();

echo $setting->status(); //Output => Setting is disabled

$innerSetting = Setting::make();
$innerSetting->toggleStatus();

echo $innerSetting->status(); // Output => Setting is enabled
echo $setting->status(); //Output => Setting is enabled

//In singleton, it does not matter how many you instantiate objects,
//  only single object is created and share the same methods and properties
