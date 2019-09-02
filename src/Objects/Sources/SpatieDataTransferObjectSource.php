<?php

namespace DivineOmega\uxdm\Objects\Sources;

use DivineOmega\uxdm\Interfaces\SourceInterface;
use DivineOmega\uxdm\Objects\DataItem;
use DivineOmega\uxdm\Objects\DataRow;

class SpatieDataTransferObjectSource implements SourceInterface
{

    public function getDataRows(int $page = 1, array $fieldsToRetrieve = []): array
    {
        // TODO: Implement getDataRows() method.
    }

    public function countDataRows(): int
    {
        // TODO: Implement countDataRows() method.
    }

    public function countPages(): int
    {
        // TODO: Implement countPages() method.
    }

    public function getFields(): array
    {
        // TODO: Implement getFields() method.
    }
}
