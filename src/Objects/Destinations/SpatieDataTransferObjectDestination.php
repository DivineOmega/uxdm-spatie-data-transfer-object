<?php

namespace DivineOmega\uxdm\Objects\Destinations;

use DivineOmega\uxdm\Interfaces\DestinationInterface;
use DivineOmega\uxdm\Objects\DataRow;

class SpatieDataTransferObjectDestination implements DestinationInterface
{
    /**
     * @var string
     */
    private $dataTransferObjectClass;

    /**
     * @var string
     */
    private $dataTransferObjectCollectionClass;

    public function __construct(string $dataTransferObjectClass, string $dataTransferObjectCollectionClass)
    {
        $this->dataTransferObjectClass = $dataTransferObjectClass;
        $this->dataTransferObjectCollectionClass = $dataTransferObjectCollectionClass;
    }

    public function putDataRows(array $dataRows): void
    {
        $items = [];

        /** @var DataRow $dataRow */
        foreach ($dataRows as $dataRow) {
            $dataTransferObject = new $this->dataTransferObjectClass($dataRow->toArray());
            $items[] = $dataTransferObject;
        }

        return new $this->dataTransferObjectCollectionClass($items);

    }

    public function finishMigration(): void
    {
    }
}
