<?php


namespace Hotels\App;


use Hotels\App\Exceptions\DecodeException;

interface WriterInterface
{
    /**
     * @param RowInterface $row
     */
    public function persist(RowInterface $row): void;

    /**
     * @throws DecodeException
     */
    public function flush(): void;
}