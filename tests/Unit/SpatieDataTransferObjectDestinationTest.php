<?php

namespace DivineOmega\uxdm\Tests;

use DivineOmega\uxdm\Objects\DataItem;
use DivineOmega\uxdm\Objects\DataRow;
use DivineOmega\uxdm\Objects\Destinations\SpatieDataTransferObjectDestination;
use DivineOmega\uxdm\TestClasses\SpatieDataTransferObject\UserDTO;
use DivineOmega\uxdm\TestClasses\SpatieDataTransferObject\UserDTOCollection;
use PHPUnit\Framework\TestCase;

final class SpatieDataTransferObjectDestinationTest extends TestCase
{
    private $collection = null;

    private function getDestination()
    {
        $this->collection = new UserDTOCollection();
        return new SpatieDataTransferObjectDestination($this->collection, UserDTO::class);
    }

    private function createDataRows()
    {
        $faker = \Faker\Factory::create();

        $dataRows = [];

        $dataRow = new DataRow();
        $dataRow->addDataItem(new DataItem('id', 1, true));
        $dataRow->addDataItem(new DataItem('name', $faker->name));
        $dataRow->addDataItem(new DataItem('email', $faker->email));
        $dataRows[] = $dataRow;

        $dataRow = new DataRow();
        $dataRow->addDataItem(new DataItem('id', 2, true));
        $dataRow->addDataItem(new DataItem('name', $faker->name));
        $dataRow->addDataItem(new DataItem('email', $faker->email));
        $dataRows[] = $dataRow;

        return $dataRows;
    }

    private function alterDataRows(array $dataRows)
    {
        $faker = \Faker\Factory::create();

        foreach ($dataRows as $dataRow) {
            $dataItem = $dataRow->getDataItemByFieldName('email');
            $dataItem->value = $faker->email;
        }

        return $dataRows;
    }

    private function getActualArray()
    {
        return $this->collection->toArray();
    }

    private function getExpectedArray(array $dataRows)
    {
        $expectedArray = [];

        foreach ($dataRows as $dataRow) {
            $expectedArrayRow = [];
            foreach ($dataRow->getDataItems() as $dataItem) {
                $expectedArrayRow[$dataItem->fieldName] = $dataItem->value;
            }
            $expectedArray[] = $expectedArrayRow;
        }

        return $expectedArray;
    }

    public function testPutDataRows()
    {
        $dataRows = $this->createDataRows();

        $destination = $this->getDestination();

        $destination->putDataRows($dataRows);

        $this->assertEquals($this->getExpectedArray($dataRows), $this->getActualArray());

        $dataRows = $this->alterDataRows($dataRows);

        $destination->putDataRows($dataRows);

        $this->assertEquals($this->getExpectedArray($dataRows), $this->getActualArray());

        $destination->finishMigration();
    }
}
