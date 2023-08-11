<?php

interface Subject {
    public function attach(Observer $observer);
    public function detach($index);
    public function notify();
}

interface Observer {
    public function handle();
}

class Login implements Subject {

    protected $observers = [];

    public function attach($observable)
    {
        if(is_array($observable))
        {
            return $this->attachObservers($observable);
        }

        $this->observers[] = $observable;
        return $this;
    }

    protected function attachObservers($observable)
    {
        foreach($observable as $observer)
            {
                if(!$observer instanceof Observer) {
                    throw new Error("Unsported type. Only allow observer");
                }
                $this->attach($observer);
            }
            return;
    }

    public function detach($index)
    {
        unset($this->observers[$index]);
    }

    public function notify()
    {
        foreach ($this->observers as $observer)
        {
            $observer->handle();
        }
    }

    public function fire()
    {
        $this->notify();
    }

}

class LogHandler implements Observer
{
    public function handle()
    {
        var_dump('log something important.');
    }
}

class EmailNotifier implements Observer
{
    public function handle()
    {
        var_dump('fire off email.');
    }
}

$login = new Login;
$login->attach([
    new LogHandler,
    new EmailNotifier
]);

$login->fire();