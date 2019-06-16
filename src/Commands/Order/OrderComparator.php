<?php


namespace Hotels\Commands\Order;


use Hotels\App\Hotel;

interface OrderComparator
{
    /**
     * @param Hotel $a
     * @param Hotel $b
     * @return int
     */
    public function compare(Hotel $a, Hotel $b): int;

}