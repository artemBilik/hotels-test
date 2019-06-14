<?php


use Hotels\Storages\Encoders\JsonEncoder;
use PHPUnit\Framework\TestCase;

class JsonEncoderTest extends TestCase
{

    public function testDecode()
    {
        $json = new JsonEncoder();
        $this->assertSame('{"name":"Test","max":5}', $json->encode(['name' => 'Test', 'max' => 5]), 'json wrong encode');
    }

}