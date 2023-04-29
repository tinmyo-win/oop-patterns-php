<?php
interface Image
{
    public function display();
}

class RealImage implements Image
{
    public $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->loadFromDisk();
    }

    public function display()
    {
        echo "Displaying " . $this->filename . "<br>";
    }

    private function loadFromDisk()
    {
        echo "Loading " . $this->filename . " from disk<br>";
        sleep(1); // let say image loading is 1 second
    }
}

class ProxyImage implements Image
{
    private $filename;
    static $realImage;

    public function __construct($filename)
    {
        echo "Created Image with Proxy<br>";
        $this->filename = $filename;
    }

    public function display()
    {
        if (ProxyImage::$realImage == null ||(isset(ProxyImage::$realImage) && ProxyImage::$realImage->filename != $this->filename )) {
            ProxyImage::$realImage = new RealImage($this->filename);
        }
        ProxyImage::$realImage->display();
    }
}



$startTime = microtime(true);
// Client code
$image2 = new ProxyImage("image2.jpg"); // We only instantiate Proxy Image and
    //  not yet built real Image because it cost time and resource 
$image2->display();

$image2 = new ProxyImage("image2.jpg");
$image2->display();

$endTime = microtime(true);
$elapsedTime = $endTime - $startTime;

echo "<i>Total time for 2 images in Proxy Image Viewer : " . $elapsedTime . " seconds</i> <br><br>";

$startTime = microtime(true);

$image2 = new RealImage("image2.jpg");
$image2->display();

$image2 = new RealImage("image2.jpg");
$image2->display();

$endTime = microtime(true);
$elapsedTime = $endTime - $startTime;

echo "<i>Total time for 2 images in Real Image Viewer : " . $elapsedTime . " seconds</i> <br>";


