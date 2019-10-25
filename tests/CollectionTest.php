<?php
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testEmptyInstantiatedCollectionReturnsNoItems()
    {
        $collection = new \App\Support\Collection;

        $this->assertEmpty($collection->get());
    }

    public function testCountIsCorrect()
    {
        $collection = new \App\Support\Collection([
            'one', 'two', 'three'
        ]);

        $this->assertEquals(3, $collection->count());
    }

    public function testItemsReturnedMatchedItemsPassedIn()
    {
        $collection = new \App\Support\Collection([
            'one', 'two', 'three'
        ]);

        $this->assertCount(3, $collection->get());
        $this->assertEquals($collection->get()[0], 'one');
        $this->assertEquals($collection->get()[1], 'two');
        $this->assertEquals($collection->get()[2], 'three');
    }

    public function testCollectionIsInstanceOfIteratorAggregate()
    {
        $collection = new \App\Support\Collection();

        $this->assertInstanceOf(IteratorAggregate::class, $collection);
    }

    public function testCollectionCanBeIterated()
    {
        $collection = new \App\Support\Collection([
            'one', 'two', 'three'
        ]);

        $items = [];

        foreach ($collection as $key => $value) {
            $items[] = $value;
        }

        $this->assertCount(3, $items);
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    public function testCollectionCanBeMergedWithAnotherCollection()
    {
        $collection1 = new \App\Support\Collection([
            'one', 'two', 'three'
        ]);

        $collection2 = new \App\Support\Collection([
            'four', 'five', 'six'
        ]);

        $collection1->merge($collection2);
        
        $this->assertCount(6, $collection1->get());
        $this->assertEquals(6, $collection1->count());
    }

    public function testCanAddToExistingCollection()
    {
        $collection = new \App\Support\Collection([
            'one', 'two', 'three'
        ]);
        $collection->add(['four']);

        $this->assertEquals(4, $collection->count());
        $this->assertCount(4, $collection->get());
    }

    public function testReturnsJsoneEncodedItems()
    {
        $collection = new \App\Support\Collection([
            ['username' => 'john'],
            ['username' => 'doe'],
        ]);

        $this->assertIsString($collection->toJson());
        $this->assertEquals('[{"username":"john"},{"username":"doe"}]', $collection->toJson());
    }

    public function testJsonEncodingCollectionObjetReturnsJsone()
    {
        $collection = new \App\Support\Collection([
            ['username' => 'john'],
            ['username' => 'doe'],
        ]);

        $encoded = json_encode($collection);

        $this->assertIsString($encoded);
        $this->assertEquals('[{"username":"john"},{"username":"doe"}]', $encoded);
    }
}
