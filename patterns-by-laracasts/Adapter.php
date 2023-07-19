<?php

interface BookInterface
{
    public function open();
    public function turnPage();
}

class Book implements BookInterface
{
    public function open() {
        var_dump('opening the book');
    }

    public function turnPage() {
        var_dump('turning the page of the paper book');
    }
}

interface eReaderInterface
{
    public function turnOn();
    public function clickNextButton();
}

class Kindle implements eReaderInterface
{
    public function turnOn() {
        var_dump('opening the kindle');
    }

    public function clickNextButton() {
        var_dump('click the next page button');
    }
}

class Nook implements eReaderInterface
{
    public function turnOn() {
        var_dump('opening the nook');
    }

    public function clickNextButton() {
        var_dump('click the next page button of nook ');
    }
}

class eReaderAdapter implements BookInterface
{
    protected $reader;

    public function __construct(eReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    public function open()
    {
        $this->reader->turnOn();
    }

    public function turnPage()
    {
        $this->reader->clickNextButton();
    }
}

class Person
{
    public function read(BookInterface $book) {
        $book->open();
        $book->turnPage();
    }
}

(new Person)->read(new eReaderAdapter(new Nook));