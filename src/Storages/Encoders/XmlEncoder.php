<?php


namespace Hotels\Storages\Encoders;


use Hotels\Storages\Writers\EncodeInterface;
use SimpleXMLElement;

class XmlEncoder implements EncodeInterface
{

    /** {@inheritDoc} */
    public function encode(array $data): string
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><body></body>');
        foreach ($data as $item) {
            $row = $xml->addChild('row');
            foreach($item as $name => $value) {
                $row->addChild($name, $value);
            }
        }
        return $xml->asXML();
    }
}