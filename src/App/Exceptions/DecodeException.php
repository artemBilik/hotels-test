<?php


namespace Hotels\App\Exceptions;


class DecodeException extends AppException
{
    public function __construct(string $error)
    {
        parent::__construct(sprintf('error while decode hotel: [%s]', $error));
    }
}