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

            $newDataTransferObject = new $this->dataTransferObjectClass($dataRow->toArray());

            $keyDataItems = $dataRow->getKeyDataItems();

            foreach ($this->dataTransferObjectCollection as $key => $dataTransferObject) {
                $keyDataItemsFound = 0;

                foreach ($keyDataItems as $keyDataItem) {
                    $fieldName = $keyDataItem->fieldName;
                    if (isset($dataTransferObject->$fieldName) && $dataTransferObject->$fieldName === $keyDataItem->value) {
                        $keyDataItemsFound++;
                    }
                }

                if ($keyDataItemsFound === count($keyDataItems)) {
                    $this->dataTransferObjectCollection[$key] = $newDataTransferObject;
                    continue 2;
                }
            }

            $this->dataTransferObjectCollection[] = $newDataTransferObject;
        }
    }

    public function finishMigration(): void
    {
    }
}
