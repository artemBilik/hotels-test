<?php


use Hotels\Storages\ReaderFactory;
use PHPUnit\Framework\TestCase;

class ReaderFactoryTest extends TestCase
{

    /**
     * @expectedException UnexpectedValueException
     */
    public function testWrongParser()
    {
        (new ReaderFactory())->create('file', 'yam', $this->getHotelsFile());
    }

    /**
     * @expectedException UnexpectedValueException
     */
    public function testWrongReader()
    {
        (new ReaderFactory())->create('socket', 'csv', $this->getHotelsFile());
    }

    /**
     * @expectedException UnexpectedValueException
     */
    public function testWrongFilePath()
    {
        (new ReaderFactory())->create('file', 'csv', '/path/to/file.csv');
    }

    private function getHotelsFile(): string
    {
        return sprintf('%s/data/hotels.csv', __DIR__);
    }

}