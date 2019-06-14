<?php


namespace Hotels\App;


class Hotel
{
    /** @var string */
    private $name;
    /** @var string */
    private $url;
    /** @var int */
    private $start;

    public function __construct(string $name, string $url, int $start)
    {
        $this->name = $name;
        $this->url = $url;
        $this->start = $start;
    }
}