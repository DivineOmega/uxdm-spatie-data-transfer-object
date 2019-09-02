<?php

namespace DivineOmega\uxdm\Objects\Sources;

use DivineOmega\uxdm\Interfaces\SourceInterface;
use DivineOmega\uxdm\Objects\DataItem;
use DivineOmega\uxdm\Objects\DataRow;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\DataTransferObjectCollection;

class SpatieDataTransferObjectSource extends AssociativeArraySource implements SourceInterface
{
    public function __construct(DataTransferObjectCollection $collection)
    {
        $array = $collection->toArray();

        parent::__construct($array);
    }
}
