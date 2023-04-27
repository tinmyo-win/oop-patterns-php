<?php

interface Logger
{
    public function log(string $msg);
}

class BasicLogger implements Logger
{
    public function log(string $msg)
    {
        return $msg;
    }
}

class HTMLDecorator implements Logger
{
    public $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
    public function log(string $msg)
    {
        return "&lt;html&gt;" . $this->logger->log($msg) . "&lt;/html&gt;";
    }
}

class TimeDecorator implements Logger
{
    public $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
    public function log(string $msg)
    {
        $time = date('Y-m-d H:i:s', time());
        return $time . $this->logger->log($msg);
    }
}

$logger = new TimeDecorator(new HTMLDecorator(new BasicLogger()));
echo $logger->log("This is my log");
