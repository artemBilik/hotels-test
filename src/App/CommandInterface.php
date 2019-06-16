<?php


namespace Hotels\App;


interface CommandInterface
{
    /**
     * @param Hotel $hotel
     */
    public function push(Hotel $hotel): void;

    /**
     * @return RowInterface[]
     */
    public function process(): array;
}