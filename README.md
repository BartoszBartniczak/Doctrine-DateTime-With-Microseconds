Doctrine DateTime With Microseconds
====================================

### Standard Doctrine behavior

Doctrine saves `\DateTime` to the database correctly, but omits the microseconds, which are part of the `\DateTime` object. 

### Example mapping:

![1549735833745](docs/example-mapping.png)

The Doctrine ORM saves the date, but without microseconds:

![1549735952539](docs/doctrine-result.png)

In some systems this behavior is not expected. There are some situations where the microseconds are very important information, so they should be persisted.



***Caution: Not every Database system supports Timestamps with microseconds***

## TODO

- [ ] Unit tests
- [ ] All DB tests 
- [ ] null values



