<?php


namespace Hotels\Storages\Readers;


use Hotels\App\Hotel;

interface  DecodeInterface
{
    /**
     * @param string $line
     * @return Hotel
     * @throws Hotel
     */
    public function decode(string $line): Hotel;
}