<?php
/**
 * Extends the Zend Config XML library to allow attribute handling.
 */

namespace App\Xml;

use XMLReader;
use Zend\Config\Exception;

/**
 * XML config reader.
 */
class Reader extends \Zend\Config\Reader\Xml
{
    /**
     * Get all attributes on the current node.
     *
     * @return array
     */
    protected function getAttributes()
    {
        $attributes = [];

        if ($this->reader->hasAttributes) {
            while ($this->reader->moveToNextAttribute()) {
                $attributes['@'.$this->reader->localName] = $this->reader->value;
            }

            $this->reader->moveToElement();
        }

        return $attributes;
    }
}