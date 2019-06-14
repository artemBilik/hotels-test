<?php


use Hotels\Storages\WriterFactory;
use PHPUnit\Framework\TestCase;

class FileWriterTest extends TestCase
{

    public function testWrite()
    {
        $filePath = sprintf('%s/data/result.csv', __DIR__);
        $writer = (new WriterFactory())->create('file', 'json', $filePath);
        $writer->persist(['name' => 'test', 'max' => 5]);
        $writer->persist(['name' => 'chest', 'max' => 3]);
        $writer->flush();
        $json = '[{"name":"test","max":5},{"name":"chest","max":3}]';
        $this->assertSame(file_get_contents($filePath), $json, 'wrong json in file');
        unlink($filePath);
    }

}