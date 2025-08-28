<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testToString()
    {
        $item = new Item('testName', 9, 999);

        $actual = $item->__toString();

        $this->assertSame('testName, 9, 999', $actual);
    }
}
