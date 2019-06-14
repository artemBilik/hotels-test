<?php


use Hotels\Storages\Encoders\CsvEncoder;
use PHPUnit\Framework\TestCase;
use Hotels\App\Hotel;

class CsvEncoderTest extends TestCase
{

    public function testDecode()
    {
        $csv = new CsvEncoder();
        $hotel = $csv->decode('Test;http://url.com;3');
        $this->assertEquals(new Hotel('Test', 'http://url.com', 3), $hotel, 'wrong csv decoded hotel');
    }
    /**
     * @expectedException \Hotels\App\Exceptions\HotelDataCorruptedException
     */
    public function testCorruptedData()
    {
        $csv = new CsvEncoder();
        $csv->decode('Test,http://url.com;3');
    }

}