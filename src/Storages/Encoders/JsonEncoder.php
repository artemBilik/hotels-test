<?php


namespace Hotels\Storages\Encoders;


use Hotels\Storages\Exceptions\DecodeException;
use Hotels\Storages\Writers\EncodeInterface;
use JsonException;

class JsonEncoder implements EncodeInterface
{
    /** {@inheritDoc} */
    public function encode(array $data): string
    {
        try {
            return json_encode($data, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new DecodeException($e->getMessage());
        }
    }
}