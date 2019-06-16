<?php


namespace Hotels\Storages;


use Hotels\App\WriterInterface;
use Hotels\Storages\Encoders\JsonEncoder;
use Hotels\Storages\Encoders\XmlEncoder;
use Hotels\Storages\Writers\FileWriter;
use UnexpectedValueException;

class WriterFactory
{
    public const JSON_ENCODER = 'json';
    public const XML_ENCODER = 'xml';
    public const FILE_WRITER = 'file';

    public function create(string $type, string $encoderName, string $filePath): WriterInterface
    {
        if ($encoderName === self::JSON_ENCODER) {
            $encoder = new JsonEncoder();
        } elseif($encoderName === self::XML_ENCODER) {
            $encoder = new XmlEncoder();
        } else {
            throw new UnexpectedValueException(sprintf('undefined encoder[%s] in writer', $encoderName));
        }
        if ($type === self::FILE_WRITER) {
            return new FileWriter($filePath, $encoder);
        } else {
            throw new UnexpectedValueException('undefined writer');
        }
    }
}