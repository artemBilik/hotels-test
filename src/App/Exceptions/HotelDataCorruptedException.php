<?php


namespace Hotels\App\Exceptions;


class HotelDataCorruptedException extends AppException
{
    public function __construct(string $line)
    {
        parent::__construct(sprintf('hotel data corrupted: [%s]', $line));
    }
}