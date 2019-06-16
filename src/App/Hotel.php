<?php


namespace Hotels\App;


use UnexpectedValueException;

class Hotel implements RowInterface
{
    /** @var string */
    private $name;
    /** @var string */
    private $url;
    /** @var int */
    private $star;

    /**
     * Hotel constructor.
     * @param string $name
     * @param string $url
     * @param int $star
     * @throws UnexpectedValueException
     */
    public function __construct(string $name, string $url, int $star)
    {
        if ($star < 1 || $star > 5) {
            throw new UnexpectedValueException(sprintf('star[%d] is not valid', $star));
        }
        $this->name = $name;
        $this->url = $url;
        $this->star = $star;
    }

    public function toArray(): array
    {
        return ['name' => $this->name, 'url' => $this->url, 'star' => $this->star];
    }

    public function getField(string $name)
    {
        switch($name) {
            case 'name':
                return $this->name;
            case 'url':
                return $this->url;
            default:
                return null;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getStar(): int
    {
        return $this->star;
    }
}