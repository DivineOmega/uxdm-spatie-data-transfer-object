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

            $index = $this->findInCollection($dataRow);

            $newDataTransferObject = new $this->dataTransferObjectClass($dataRow->toArray());

            if ($index === null) {
                $this->dataTransferObjectCollection[] = $newDataTransferObject;
            } else {
                $this->dataTransferObjectCollection[$index] = $newDataTransferObject;
            }

        }
    }

    /**
     * Attempts to locate an existing data transfer object in the data transfer object collection
     * that matches the key data items of the passed data row.
     *
     * If found, its index within the collection is returned.
     *
     * @param DataRow $dataRow
     * @return int|null
     */
    private function findInCollection(DataRow $dataRow): ?int
    {
        $keyDataItems = $dataRow->getKeyDataItems();

        foreach ($this->dataTransferObjectCollection as $index => $dataTransferObject) {
            $keyDataItemsFound = 0;

            foreach ($keyDataItems as $keyDataItem) {
                $fieldName = $keyDataItem->fieldName;
                if (isset($dataTransferObject->$fieldName) && $dataTransferObject->$fieldName === $keyDataItem->value) {
                    $keyDataItemsFound++;
                }
            }

            if ($keyDataItemsFound === count($keyDataItems)) {
                return $index;
            }
        }

        return null;
    }

    public function finishMigration(): void
    {
    }
}
