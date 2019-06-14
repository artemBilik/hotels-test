<?php


namespace Hotels\App;


use Hotels\App\Exceptions\DecodeException;

interface WriterInterface
{
    /**
     * @param mixed[] $row
     */
    public function persist(array $row): void;

    /**
     * @throws DecodeException
     */
    public function flush(): void;
}