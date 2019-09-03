<?php

namespace DivineOmega\uxdm\Objects\Destinations;

use DivineOmega\uxdm\Interfaces\DestinationInterface;
use DivineOmega\uxdm\Objects\DataRow;
use Spatie\DataTransferObject\DataTransferObjectCollection;

class SpatieDataTransferObjectDestination implements DestinationInterface
{
    /**
     * @var DataTransferObjectCollection
     */
    private $dataTransferObjectCollection;

    /**
     * @var string
     */
    private $dataTransferObjectClass;

    public function __construct(DataTransferObjectCollection &$dataTransferObjectCollection, string $dataTransferObjectClass)
    {
        $this->dataTransferObjectCollection = $dataTransferObjectCollection;
        $this->dataTransferObjectClass = $dataTransferObjectClass;
    }

    public function putDataRows(array $dataRows): void
    {
        /** @var DataRow $dataRow */
        foreach ($dataRows as $dataRow) {
            $dataTransferObject = new $this->dataTransferObjectClass($dataRow->toArray());
            $this->dataTransferObjectCollection[] = $dataTransferObject;
        }
    }

    public function finishMigration(): void
    {
    }
}
