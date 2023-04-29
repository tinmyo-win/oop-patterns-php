<?php

interface Command {
    public function execute();
}

class CopyCommand implements Command {
    public function __construct()
    {
        
    }

    public function execute() {
        echo("Copy Executed <br>");
    } 
}

class EditCommand implements Command {
    public function __construct()
    {
        
    }
    public function execute() {
        echo("Edit Executed <br>");
    } 
}

class Paste implements Command {
    public function __construct()
    {
        
    }
    public function execute() {
        echo("Paste <br>");
    } 
}

class Invoker {
    public $history;
    
    public function invoke(Command $command)
    {
        $this->history[] = $command;
        $command->execute();
    }
    public function undo()
    {
        $len = count($this->history) - 1;
        $command = $this->history[$len];
        unset($this->history[$len]);
        echo("Undo ");
        $command->execute();
    }
}

$invoker = new Invoker();
$copy = new CopyCommand();
$invoker->invoke($copy);

$paste = new Paste();
$invoker->invoke($paste);

$invoker->undo();
$invoker->undo();