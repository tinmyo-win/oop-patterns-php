<?php

define("TYPEC", "typec");
define("HEADPHONEJACK", "headphonejack");

class Headphone
{
    public $name;
    public $connector;
    public function __construct(string $name, $connector)
    {
        $this->name = $name;
        $this->connector = $connector;
    }

    public function connectToPhone(Phone $phone)
    {

        echo ($phone->headphone_port == $this->connector) ?
            "Connected to headphone<br>"
            :
            "Cannot connect to typeC with head jack<br>";
    }
}

class HeadphoneAdapter extends Headphone
{
    public function connectToPhone(Phone $phone)
    {
        $this->connector = $phone->headphone_port == HEADPHONEJACK ?
            HEADPHONEJACK
            :
            $this->extendsToTypeC();

        parent::connectToPhone($phone);
    }

    public function extendsToTypeC()
    {
        return $this->connector = TYPEC;
    }
}

class Phone
{
    public $model;
    public $headphone_port;

    public function __construct($model, $headphone_port)
    {
        $this->model = $model;
        $this->headphone_port = $headphone_port;
    }
}

$mi10 = new Phone("mi10", TYPEC);

echo "Connecting to TypeC port with headphone jack => ";
$headphone = new Headphone('hoco', HEADPHONEJACK);
$headphone->connectToPhone($mi10);

echo "Connecting to TypeC port with TypeC adapter => ";
$headphone_adapter = new HeadphoneAdapter('hoco', HEADPHONEJACK);
$headphone_adapter->connectToPhone($mi10);
