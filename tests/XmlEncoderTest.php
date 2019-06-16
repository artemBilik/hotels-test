<?php


use Hotels\Storages\Encoders\XmlEncoder;
use PHPUnit\Framework\TestCase;

class XmlEncoderTest extends TestCase
{

    public function testDecode()
    {
        $xmlEncoder = new XmlEncoder();
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.'<body><row><name>Test</name><max>5</max></row><row><name>chest</name><max>3</max></row></body>'.PHP_EOL;
        $this->assertSame($xml, $xmlEncoder->encode([['name' => 'Test', 'max' => 5], ['name' => 'chest', 'max' => 3]]), 'json wrong encode');
    }

}