<?php


use Hotels\Storages\WriterFactory;
use PHPUnit\Framework\TestCase;

class WriterFactoryTest extends TestCase
{

    /**
     * @expectedException UnexpectedValueException
     */
    public function testWrongEncoder()
    {
        (new WriterFactory())->create('file', 'yuam', $this->getHotelsFile());
    }

    /**
     * @expectedException UnexpectedValueException
     */
    public function testWrongReader()
    {
        (new WriterFactory())->create('socket', 'json', $this->getHotelsFile());
    }

    /**
     * @expectedException UnexpectedValueException
     */
    public function testWrongFilePath()
    {
        (new WriterFactory())->create('file', 'json', '/path/to/file.csv');
    }

    private function getHotelsFile(): string
    {
        return sprintf('%s/data/result.csv', __DIR__);
    }

    public function __destruct()
    {
        if (file_exists($this->getHotelsFile())) {
            unlink($this->getHotelsFile());
        }
    }

}