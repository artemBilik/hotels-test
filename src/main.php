<?php

use Hotels\App\App;
use Hotels\App\Exceptions\AppException;
use Hotels\Commands\CommandFactory;
use Hotels\Exceptions\OptionCorruptedException;
use Hotels\Option;
use Hotels\Storages\ReaderFactory;
use Hotels\Storages\WriterFactory;

require __DIR__ . '/../vendor/autoload.php';

if (count($argv) !== 4) {
    echo "Не хватает парметров для вызова [input data output]\n";
    exit(1);
}

try {
    $reader = new Option($argv[1], ['encoder', 'path']);
    $command = new Option($argv[2], ['field', 'param']);
    $writer = new Option($argv[3], ['encoder', 'path']);
} catch (OptionCorruptedException $e) {
    echo sprintf("Параметры вызова[%s] указаны неверно [command(param1,param2)]\n", $e->getMessage());
    exit(1);
}
try {
    $reader = (new ReaderFactory())->create($reader->getCommand(), $reader->getParam('encoder'), $reader->getParam('path'));
    $writer = (new WriterFactory())->create($writer->getCommand(), $writer->getParam('encoder'), $writer->getParam('path'));
    $command = (new CommandFactory())->create($command->getCommand(), $command->getParam('field'), $command->getParam('param'));
} catch (UnexpectedValueException $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
try {
    $app = new App($reader, $command, $writer);
    $app->run();
} catch (AppException $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
