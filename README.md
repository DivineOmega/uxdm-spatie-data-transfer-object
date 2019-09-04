# UXDM Spatie Data Transfer Object

[![Build Status](https://travis-ci.com/DivineOmega/uxdm-spatie-data-transfer-object.svg?branch=master)](https://travis-ci.com/DivineOmega/uxdm-spatie-data-transfer-object)
[![Coverage Status](https://coveralls.io/repos/github/DivineOmega/uxdm-spatie-data-transfer-object/badge.svg?branch=master)](https://coveralls.io/github/DivineOmega/uxdm-spatie-data-transfer-object?branch=master)

The UXDM Spatie Data Transfer Object package provides a UXDM source and destination for Data Transfer Objects
that are created using the [Spatie Data Transfer Object package](https://github.com/spatie/data-transfer-object).

If you have not used UXDM before to migrate your data, visit the 
[UXDM GitHub repository](https://github.com/divineomega/uxdm) to learn more.

## Installation

To install the UXDM Spatie Data Transfer Object package, just run the following composer command.

```bash
composer require divineomega/uxdm-spatie-data-transfer-object
```

## UXDM Spatie Data Transfer Object Source

The UXDM Spatie Data Transfer Object source allows you to source data from a Spatie Data Transfer Object Collection.

### Creating

To create a new Spatie Data Transfer Object source, you must provide it with a populated Spatie Data Transfer Object 
Collection.

The following example creates a Spatie Data Transfer Object source object, using a collection of users data transfer 
objects.

```php
$users = new UserDTOCollection([
    new UserDTO([
        'id' => 1,
        'name' => 'Picard`',
        'email' => 'picard@enterprise-d.com',
    ]),
    new UserDTO([
        'id' => 2,
        'name' => 'Janeway',
        'email' => 'janeway@voyager.com',
    ])
]);

$spatieDataTransferObjectSource = new SpatieDataTransferObjectSource($users);
```

### Assigning to migrator

To use the Spatie Data Transfer Object source as part of a UXDM migration, you must assign it to the migrator.
This process is the same for most sources.

```php
$migrator = new Migrator;
$migrator->setSource($spatieDataTransferObjectSource);
```

## UXDM Spatie Data Transfer Object Destination

The UXDM Spatie Data Transfer Object destination allows you to migrate data into a Spatie Data Transfer Object Collection.

### Creating

To create a new Spatie Data Transfer Object destination, you must provide it with a Spatie Data Transfer Object 
Collection, and the class name of a Spatie Data Transfer Object.

The following example creates a Spatie Data Transfer Object destination object, using an empty collection, and the name
of a user data transfer object class.

```php
$users = new UserDTOCollection();
$spatieDataTransferObjectDestination = new SpatieDataTransferObjectDestination($users, UserDTO::class);
```

### Assigning to migrator

To use the Spatie Data Transfer Object destination as part of a UXDM migration, you must assign it to the migrator. 
This process is the same for most destinations.

```php
$migrator = new Migrator;
$migrator->setDestination($spatieDataTransferObjectDestination);
```

Alternatively, you can add multiple destinations, as shown below. You can also specify the fields you wish to send to each destination by passing an array of field names as the second parameter.

```php
$migrator = new Migrator;
$migrator->addDestination($spatieDataTransferObjectDestination, ['field1', 'field2']);
$migrator->addDestination($otherDestination, ['field3', 'field2']);
```
