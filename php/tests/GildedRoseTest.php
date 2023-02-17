<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    private function itemUpdateOnceTest(array $constructParameters, int $expectedSellIn, int $expectedQuality): void
    {
        $items = [new Item(...$constructParameters)];
        $app = new GildedRose($items);
        $app->updateQuality();
        $this->assertSame($expectedSellIn, $items[0]->sellIn);
        $this->assertSame($expectedQuality, $items[0]->quality);
    }

    public function testNormalItem(): void
    {
        $this->itemUpdateOnceTest(['normal', 5, 10], 4, 9);
        $this->itemUpdateOnceTest(['normal', 0, 10], -1, 8);
        $this->itemUpdateOnceTest(['normal', -5, 10], -6, 8);
        $this->itemUpdateOnceTest(['normal', 5, 0], 4, 0);
    }

    public function testAgedBrie(): void
    {
        $this->itemUpdateOnceTest(['Aged Brie', 5, 10], 4, 11);
        $this->itemUpdateOnceTest(['Aged Brie', 5, 50], 4, 50);
        $this->itemUpdateOnceTest(['Aged Brie', 0, 10], -1, 12);
        $this->itemUpdateOnceTest(['Aged Brie', 0, 49], -1, 50);
        $this->itemUpdateOnceTest(['Aged Brie', 0, 50], -1, 50);
        $this->itemUpdateOnceTest(['Aged Brie', -10, 10], -11, 12);
        $this->itemUpdateOnceTest(['Aged Brie', -10, 50], -11, 50);
    }

    public function testSulfuras(): void
    {
        $this->itemUpdateOnceTest(['Sulfuras, Hand of Ragnaros', 5, 10], 5, 10);
        $this->itemUpdateOnceTest(['Sulfuras, Hand of Ragnaros', 0, 10], 0, 10);
        $this->itemUpdateOnceTest(['Sulfuras, Hand of Ragnaros', -1, 10], -1, 10);
    }

    public function testBackstagePasses(): void
    {
        $this->itemUpdateOnceTest(['Backstage passes to a TAFKAL80ETC concert', 11, 10], 10, 11);
        $this->itemUpdateOnceTest(['Backstage passes to a TAFKAL80ETC concert', 10, 10], 9, 12);
        $this->itemUpdateOnceTest(['Backstage passes to a TAFKAL80ETC concert', 10, 50], 9, 50);
        $this->itemUpdateOnceTest(['Backstage passes to a TAFKAL80ETC concert', 5, 10], 4, 13);
        $this->itemUpdateOnceTest(['Backstage passes to a TAFKAL80ETC concert', 5, 50], 4, 50);
        $this->itemUpdateOnceTest(['Backstage passes to a TAFKAL80ETC concert', 1, 50], 0, 50);
        $this->itemUpdateOnceTest(['Backstage passes to a TAFKAL80ETC concert', 0, 10], -1, 0);
        $this->itemUpdateOnceTest(['Backstage passes to a TAFKAL80ETC concert', -1, 10], -2, 0);
    }

    public function testConjured(): void
    {
        $this->itemUpdateOnceTest(['Conjured', 10, 10], 9, 8);
        $this->itemUpdateOnceTest(['Conjured', 6, 1], 5, 0);
        $this->itemUpdateOnceTest(['Conjured', 1, 3], 0, 1);
        $this->itemUpdateOnceTest(['Conjured', 0, 10], -1, 6);
        $this->itemUpdateOnceTest(['Conjured', -1, 10], -2, 6);
    }
}
