<?php


namespace Hotels\Commands\Order\Comparators;


use Hotels\App\Hotel;
use Hotels\Commands\Order\OrderComparator;

class UrlComparator implements OrderComparator
{

    /**
     * {@inheritDoc}
     */
    public function compare(Hotel $a, Hotel $b): int
    {
        $aUrl = $a->getUrl();
        $bUrl = $b->getUrl();
        if ($aUrl === $bUrl) {
            return 0;
        }
        return $aUrl > $bUrl ? 1 : -1;
    }
}