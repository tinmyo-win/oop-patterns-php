<?php

abstract class Component
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function display();
}

class File extends Component
{
    public function display()
    {
        echo "File: {$this->name} <br>";
    }
}

class Folder extends Component
{
    protected $children = [];

    public function add_child($child)
    {
        array_push($this->children, $child);
    }

    public function remove_child($child)
    {
        $index = array_search($child, $this->children);
        if ($index !== false) {
            array_splice($this->children, $index, 1);
        }
    }

    public function display()
    {
        echo "Folder: {$this->name} <br>";
        foreach ($this->children as $child) {
            $child->display();
        }
    }
}

$file1 = new File("file1.txt");
$file2 = new File("file2.txt");

// Create a folder and add the files to it
$folder1 = new Folder("folder1");
$folder1->add_child($file1);
$folder1->add_child($file2);

// Create another file and folder
$file3 = new File("file3.txt");
$folder2 = new Folder("folder2");
$folder2->add_child($file3);

// Add the second folder to the first folder
$folder1->add_child($folder2);

// Display the entire file system
$folder1->display();

// Output tree Structure

// $Folder1 = [
//     'file1.txt',
//     'file2.txt',
//     'Folder2' => [
//         'file3.txt'
//     ]
// ];
