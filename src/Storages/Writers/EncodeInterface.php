<?php


namespace Hotels\Storages\Writers;




use Hotels\App\Exceptions\DecodeException;

interface EncodeInterface
{
    /**
     * @param array $data
     * @return string
     * @throws DecodeException
     */
    public function encode(array $data): string;
}