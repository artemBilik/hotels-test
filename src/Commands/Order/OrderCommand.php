<?php


namespace Hotels\Commands\Order;


use Hotels\App\CommandInterface;
use Hotels\App\Hotel;
use Hotels\App\RowInterface;

class OrderCommand implements CommandInterface
{
    public const ASK = 'ask';
    public const DESC = 'desc';

    private $comparator;
    private $data = [];
    private $direction;

    public function __construct(OrderComparator $comparator, string $direction)
    {
        $this->comparator = $comparator;
        $this->direction = $direction;
    }
    /**
     * @param Hotel $hotel
     */
    public function push(Hotel $hotel): void
    {
        $this->data[] = $hotel;
    }

    /**
     * @return RowInterface[]
     */
    public function process(): array
    {
        $direction = 1;
        if ($this->direction === self::DESC) {
            $direction = -1;
        }
        usort($this->data, function(Hotel $a, Hotel $b) use ($direction) {
            return $direction * $this->comparator->compare($a, $b);
        });
        return $this->data;
    }
}