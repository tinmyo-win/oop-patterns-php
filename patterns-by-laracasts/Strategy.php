<?php

//encapsulate and make themm interchangable

interface Logger
{
    public function log($data);
}

//defint a family of algorithm

class LogToFile implements Logger
{
    public function log($data)
    {
        var_dump('saved to log file');
    }
}

class LogToDatabase implements Logger
{
    public function log($data)
    {
        var_dump('saved to database');
    }
}

class LogToXWebservice implements Logger
{
    public function log($data)
    {
        var_dump('saved to web service');
    }
}

class App
{
    public function log($data, Logger $logger = null) {
        $logger = $logger ?? new LogToFile;
        $logger->log($data);
    }
}

$app = new App;
$app->log("Some Information", new LogToDatabase);
