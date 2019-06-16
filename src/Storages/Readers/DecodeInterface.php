<?php


namespace Hotels\Storages\Readers;


use Hotels\App\Exceptions\HotelDataCorruptedException;
use Hotels\App\Hotel;

interface  DecodeInterface
{
    /**
     * @param string $line
     * @return Hotel
     * @throws Hotel
     * @throws HotelDataCorruptedException
     */
    public function decode(string $line): Hotel;
}