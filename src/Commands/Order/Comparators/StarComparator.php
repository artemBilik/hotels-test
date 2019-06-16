<?php


namespace Hotels\Commands\Order\Comparators;


use Hotels\App\Hotel;
use Hotels\Commands\Order\OrderComparator;

class StarComparator implements OrderComparator
{

    /** {@inheritDoc} */
    public function compare(Hotel $a, Hotel $b): int
    {
        return $a->getStar() - $b->getStar();
    }
}