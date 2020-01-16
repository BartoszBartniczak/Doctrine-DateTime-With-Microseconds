Doctrine DateTime With Microseconds
====================================
Doctrine plugin to save DateTime objects with microseconds in database.
------------------------------------
[![Build Status](https://travis-ci.com/BartoszBartniczak/Doctrine-DateTime-With-Microseconds.svg?branch=master)](https://travis-ci.com/BartoszBartniczak/Doctrine-DateTime-With-Microseconds)
[![Coverage Status](https://coveralls.io/repos/github/BartoszBartniczak/Doctrine-DateTime-With-Microseconds/badge.svg?branch=master)](https://coveralls.io/github/BartoszBartniczak/Doctrine-DateTime-With-Microseconds?branch=master)
-----------

### Standard Doctrine behavior

Doctrine saves `\DateTime` to the database correctly, but omits the microseconds, which are part of the `\DateTime` object. 

### Example mapping:

![1549735833745](docs/example-mapping.png)

The Doctrine ORM saves the date, but without microseconds:

![1549735952539](docs/doctrine-result.png)

In some systems this behavior is not expected. There are some situations where the microseconds are very important information, so they should be persisted.

***Caution: Not every Database system supports Timestamps with microseconds***

## Requirements

* PHP version 7.2+ (tested on 7.2, 7.3, 7.4)

## TODO

- [ ] Integration with TravisCI
- [ ] Run matrix
- [ ] Integration test All DB tests 
- [ ] installation tutorial



