<?php


namespace Hotels\Storages\Writers;


use Hotels\App\Exceptions\DecodeException;
use Hotels\App\RowInterface;

interface EncodeInterface
{
    /**
     * @param  RowInterface[] $data
     * @return string
     * @throws DecodeException
     */
    public function encode(array $data): string;
}