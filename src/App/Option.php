<?php


namespace Hotels\App;

use Hotels\App\Exceptions\OptionCorruptedException;
use Hotels\App\Exceptions\OptionParamNotExistsException;

class Option
{
    /** @var array<string,string>  */
    private $params = [];

    /** @var string */
    private $command = '';

    /**
     * Option constructor.
     * @param string $option
     * @param string[] $params
     * @throws OptionCorruptedException
     */
    public function __construct(string $option, array $params)
    {
        $pieces = [];
        if (1 !== preg_match('/^([a-z0-9]+)(\([a-z0-9,]*\))$/', $option, $pieces)) {
            throw new OptionCorruptedException();
        }
        $this->command = $pieces[1];
        $paramValues = explode(',', str_replace(['(', ')'], '', $pieces[2]));
        if (count($paramValues) !== count($params)) {
            throw new OptionCorruptedException();
        }
        foreach ($params as $key => $paramName) {
            $this->params[$paramName] = $paramValues[$key];
        }
    }

    /**
     * @param string $name
     * @return string
     * @throws OptionParamNotExistsException
     */
    public function getParam(string $name): string
    {
        if (!array_key_exists($name, $this->params)) {
            throw new OptionParamNotExistsException();
        }
        return $this->params[$name];
    }

    public function getCommand(): string
    {
        return $this->command;
    }

}
