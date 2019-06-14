<?php


use Hotels\App\Hotel;
use Hotels\Storages\ReaderFactory;
use PHPUnit\Framework\TestCase;

class FileReaderTest extends TestCase
{

    public function testRead()
    {
        $reader = (new ReaderFactory())->create('file', 'csv', sprintf('%s/data/hotels.csv', __DIR__));
        $hotels = [];
        while (!$reader->isEnd()) {
            $hotels[] = $reader->read();
        }
        $this->assertCount(2, $hotels, 'wrong hotel count');
        $hotel1 = new Hotel('Аркадия', 'http://arkadiya.com', 3);
        $this->assertEquals($hotel1, $hotels[0], 'wrong hotel 1');
        $hotel1 = new Hotel('Хостел', 'http://hostel.com', 1);
        $this->assertEquals($hotel1, $hotels[1], 'wrong hotel 2');
    }

}