<?php


namespace Hotels\App;


use Hotels\App\Exceptions\HotelDataCorruptedException;
use Hotels\App\Exceptions\ReadHotelException;

interface ReaderInterface
{
    /**
     * @return bool
     */
    public function isEnd(): bool;

    /**
     * @return Hotel
     * @throws ReadHotelException
     * @throws HotelDataCorruptedException
     */
    public function read(): Hotel;
}