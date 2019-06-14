<?php

namespace Hotels\Storages;


use Hotels\App\ReaderInterface;
use Hotels\Storages\Encoders\CsvEncoder;
use Hotels\Storages\Readers\FileReader;
use UnexpectedValueException;

class ReaderFactory
{

    public const CSV_ENCODER = 'csv';
    public const FILE_READER = 'file';

    /**
     * @param string $type
     * @param string $encoder
     * @param string $filePath
     * @return ReaderInterface
     * @throws UnexpectedValueException
     */
    public function create(string $type, string $encoder, string $filePath): ReaderInterface
    {
        if ($encoder === self::CSV_ENCODER) {
            $parser = new CsvEncoder();
        } else {
            throw new UnexpectedValueException('undefined encoder');
        }
        if ($type === self::FILE_READER) {
            return new FileReader($filePath, $parser);
        } else {
            throw new UnexpectedValueException('undefined reader');
        }
    }
}