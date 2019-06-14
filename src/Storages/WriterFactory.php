<?php


namespace Hotels\Storages;


use Hotels\App\WriterInterface;
use Hotels\Storages\Encoders\JsonEncoder;
use Hotels\Storages\Writers\FileWriter;
use UnexpectedValueException;

class WriterFactory
{
    public const JSON_ENCODER = 'json';
    public const FILE_WRITER = 'file';

    public function create(string $type, string $encoder, string $filePath): WriterInterface
    {
        if ($encoder === self::JSON_ENCODER) {
            $encoder = new JsonEncoder();
        } else {
            throw new UnexpectedValueException('undefined encoder');
        }
        if ($type === self::FILE_WRITER) {
            return new FileWriter($filePath, $encoder);
        } else {
            throw new UnexpectedValueException('undefined writer');
        }
    }
}