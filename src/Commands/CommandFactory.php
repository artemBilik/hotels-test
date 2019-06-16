<?php


namespace Hotels\Commands;


use Hotels\App\CommandInterface;
use Hotels\Commands\Group\Aggregators\AvgAggregator;
use Hotels\Commands\Group\Aggregators\CntAggregator;
use Hotels\Commands\Group\Aggregators\SumAggregator;
use Hotels\Commands\Group\GroupCommand;
use Hotels\Commands\Order\Comparators\NameComparator;
use Hotels\Commands\Order\Comparators\StarComparator;
use Hotels\Commands\Order\Comparators\UrlComparator;
use Hotels\Commands\Order\OrderCommand;
use UnexpectedValueException;

class CommandFactory
{
    public const NAME_FIELD = 'name';
    public const URL_FIELD = 'url';
    public const STAR_FIELD = 'star';
    public const ORDER_COMMAND = 'order';
    public const GROUP_COMMAND = 'group';
    public const SUM_AGGREGATOR = 'sum';
    public const AVG_AGGREGATOR = 'avg';
    public const CNT_AGGREGATOR = 'cnt';

    public function create(string $command, string $field, string $param): CommandInterface
    {
        if (!in_array($field, [self::NAME_FIELD, self::URL_FIELD, self::STAR_FIELD])) {
            throw new UnexpectedValueException('undefined field[%s] to create command', $field);
        }
        if ($command === self::ORDER_COMMAND) {
            return $this->createOrderCommand($field, $param);
        }

        if ($command === self::GROUP_COMMAND) {
            return $this->createGroupCommand($field, $param);
        }
        throw new UnexpectedValueException(sprintf('command[%s] is not implemented', $command));
    }

    public function createOrderCommand(string $field, string $direction): OrderCommand
    {
        $comparator = null;
        if ($field === self::NAME_FIELD) {
            $comparator = new NameComparator();
        }
        if ($field === self::URL_FIELD) {
            $comparator = new UrlComparator();
        }
        if ($field === self::STAR_FIELD) {
            $comparator = new StarComparator();
        }

        return new OrderCommand($comparator, $direction);
    }

    public function createGroupCommand(string $field, string $aggregator): GroupCommand
    {
        if ($aggregator === self::SUM_AGGREGATOR) {
            $aggregator = new SumAggregator();
        } elseif ($aggregator === self::AVG_AGGREGATOR) {
            $aggregator = new AvgAggregator();
        } elseif ($aggregator === self::CNT_AGGREGATOR) {
            $aggregator = new CntAggregator();
        } else {
            throw new UnexpectedValueException(sprintf('undefined aggregator[%s] for groupping', $aggregator));
        }

        return new GroupCommand($field, $aggregator);
    }
}