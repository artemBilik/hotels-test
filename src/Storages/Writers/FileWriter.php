<?php


namespace Hotels\Storages\Writers;


use Hotels\App\WriterInterface;
use RuntimeException;
use SplFileObject;
use UnexpectedValueException;

class FileWriter extends SplFileObject implements WriterInterface
{

    private $encoder;
    private $data = [];

    public function __construct(string $filePath, EncodeInterface $encoder)
    {
        $this->encoder = $encoder;
        try {
            parent::__construct($filePath, 'w');
        } catch(RuntimeException $e) {
            throw new UnexpectedValueException('open file error');
        }
    }

    public function persist(array $row): void
    {
        $this->data[] = $row;
    }

    public function flush(): void
    {
        $this->fwrite($this->encoder->encode($this->data));
    }
}