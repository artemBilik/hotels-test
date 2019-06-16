<?php


namespace Hotels\App;


class App
{

    private $reader;
    private $command;
    private $writer;

    public function __construct(ReaderInterface $reader, CommandInterface $command, WriterInterface $writer)
    {
        $this->reader = $reader;
        $this->command = $command;
        $this->writer = $writer;
    }

    /**
     * @throws Exceptions\DecodeException
     * @throws Exceptions\HotelDataCorruptedException
     * @throws Exceptions\ReadHotelException
     */
    public function run(): void
    {
        while (!$this->reader->isEnd()) {
            $this->command->push($this->reader->read());
        }
        $data = $this->command->process();
        foreach ($data as $row) {
            $this->writer->persist($row);
        }
        $this->writer->flush();
    }
}