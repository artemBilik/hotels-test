<?php


namespace Hotels\Storages\Encoders;


use Hotels\App\Exceptions\HotelDataCorruptedException;
use Hotels\Storages\Readers\DecodeInterface;
use Hotels\App\Hotel;
use UnexpectedValueException;

class CsvEncoder implements DecodeInterface
{

    private const DELIMITER = ';';

    /** {@inheritDoc} */
    public function decode(string $line): Hotel
    {
        $fields = explode(self::DELIMITER, $line);
        if (count($fields) != 3) {
            throw new HotelDataCorruptedException($line);
        }
        try {
            return new Hotel($fields[0], $fields[1], (int)$fields[2]);
        } catch (UnexpectedValueException $e) {
            throw new HotelDataCorruptedException($line);
        }
    }
}