<?php


namespace Hotels\App\Exceptions;


class ReadHotelException extends AppException
{
    public function __construct()
    {
        parent::__construct('error while reading hotels provider');
    }
}