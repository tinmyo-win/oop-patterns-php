<?php

class YouTubeDownloader
{
    protected $youtube;
    protected $ffmpeg;

    public function __construct(string $youtubeApiKey)
    {
        $this->youtube = new YouTube($youtubeApiKey);
        $this->ffmpeg = new FFMpeg();
    }

    public function downloadVideo(string $url): void
    {
        $this->youtube->fetchVideo();
        $this->youtube->saveAs();

        $this->ffmpeg->open('video.mpg');

        FFMpegVideo::create()
            ->filters()
            ->resize()
            ->synchronize();

        FFMpegVideo::create()
            ->frame()
            ->save();

        echo "Done!\n";
    }
}

/**
 * The YouTube API subsystem.
 */
class YouTube
{
    public function fetchVideo()
    {
        echo "Fetching video metadata from youtube...<br>";
    }

    public function saveAs()
    {
        echo "Saving video file to a temporary file...<br>";
    }
}

/**
 * The FFmpeg subsystem (a complex video/audio conversion library).
 */
class FFMpeg
{
    public static function create(): FFMpeg 
    {
        return new FFMpeg;
    }

    public function open(string $video)
    {
        echo "Processing source video...<br>";
    }
}

class FFMpegVideo
{
    public static function create(): FFMpegVideo
    {
        return new FFMpegVideo;
    }

    public function filters(): self
    {
        return $this;
    }

    public function resize(): self 
    {
        return $this;
    }

    public function synchronize(): self 
    {
        echo "Normalizing and resizing the video to smaller dimensions...<br>";
        return $this;
    }

    public function frame(): self 
    { 
        echo "Capturing preview image...<br>";
        return $this;
    }

    public function save()
    {
        echo "Saving video in target formats...<br>";
    }

}

function clientCode(YouTubeDownloader $facade)
{
    $facade->downloadVideo("https://www.youtube.com/watch?v=QH2-TGUlwu4");
}

$facade = new YouTubeDownloader("APIKEY-XXXXXXXXX");
clientCode($facade);
