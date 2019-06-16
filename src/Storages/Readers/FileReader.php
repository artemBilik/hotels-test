<?php

namespace Hotels\Storages\Readers;


use Hotels\App\Hotel;
use Hotels\App\ReaderInterface;
use Hotels\App\Exceptions\HotelDataCorruptedException;
use Hotels\App\Exceptions\ReadHotelException;
use RuntimeException;
use SplFileObject;
use UnexpectedValueException;

class FileReader extends SplFileObject implements ReaderInterface
{
    /** @var DecodeInterface */
    private $encoder;

    /**
     * FileReader constructor.
     * @param string $filePath
     * @param DecodeInterface $encoder
     * @throws UnexpectedValueException
     */
    public function __construct(string $filePath, DecodeInterface $encoder)
    {
        $this->encoder = $encoder;
        try {
            parent::__construct($filePath, 'r');
        } catch(RuntimeException $e) {
            throw new UnexpectedValueException('open file error');
        }
    }

    public function isEnd(): bool
    {
        return $this->eof();
    }

    /**
     * @return Hotel
     * @throws ReadHotelException
     * @throws HotelDataCorruptedException
     */
    public function read(): Hotel
    {
        if (!$this->eof()) {
            return $this->encoder->decode(rtrim($this->fgets(), PHP_EOL));
        }
        throw new ReadHotelException();
    }
}