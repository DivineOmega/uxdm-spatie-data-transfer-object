<?php

namespace DivineOmega\uxdm\TestClasses\SpatieDataTransferObject;

use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public $id;
    public $name;
    public $email;
}