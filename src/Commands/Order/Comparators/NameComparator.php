<?php


namespace Hotels\Commands\Order\Comparators;


use Hotels\App\Hotel;
use Hotels\Commands\Order\OrderComparator;

class NameComparator implements OrderComparator
{

    /**
     * {@inheritDoc}
     */
    public function compare(Hotel $a, Hotel $b): int
    {
        $aName = $a->getName();
        $bName = $b->getName();
        if ($aName === $bName) {
            return 0;
        }
        return $aName > $bName ? 1 : -1;
    }
}