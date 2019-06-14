<?php

use Hotels\App\Exceptions\OptionCorruptedException;
use Hotels\App\Exceptions\OptionParamNotExistsException;
use Hotels\App\Option;
use PHPUnit\Framework\TestCase;

class OptionTest extends TestCase
{
    public function testCreation()
    {
        try {
            new Option('csv(asdf', []);
            $this->fail('option creation failed: none close bracket');
        } catch (OptionCorruptedException $e) {
            //
        }
        try {
            new Option('csv', []);
            $this->fail('option creation failed: without params');
        } catch (OptionCorruptedException $e) {
            //
        }
        try {
            new Option('csv)', []);
            $this->fail('option creation failed: without open bracket');
        } catch (OptionCorruptedException $e) {
            //
        }
        try {
            new Option('csva,sdf)', []);
            $this->fail('option creation failed: bad command name');
        } catch (OptionCorruptedException $e) {
            //
        }
        $option = new Option('csv()', ['test']);
        $this->assertSame('csv', $option->getCommand(), 'wrong command');
    }

    public function testParams()
    {
        $option = new Option('group(sum,name)', ['aggregator', 'field']);
        $this->assertSame('sum', $option->getParam('aggregator'), 'wrong aggregator param');
        $this->assertSame('name', $option->getParam('field'), 'wrong field param');
        try {
            $option->getParam('undefined');
            $this->fail('option has not exists param');
        } catch (OptionParamNotExistsException $e) {
            //
        }
    }
}