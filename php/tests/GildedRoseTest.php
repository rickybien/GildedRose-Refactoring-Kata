<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    //-----------------
    // normal item
    //-----------------
    public function testUpdatesNormalItemsBeforeSellDate(): void
    {
        // arrange
        $items = [new Item('normal', 5, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(9, $items[0]->quality);
    }

    public function testUpdatesNormalItemsOnSellDate(): void
    {
        // arrange
        $items = [new Item('normal', 0, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(8, $items[0]->quality);
    }

    public function testUpdatesNormalItemsAfterSellDate(): void
    {
        // arrange
        $items = [new Item('normal', -5, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(-6, $items[0]->sellIn);
        $this->assertSame(8, $items[0]->quality);
    }

    public function testUpdatesNormalItemsWithAQualityOf0(): void
    {
        // arrange
        $items = [new Item('normal', 5, 0)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }

    //-----------------
    // Brie item
    //-----------------
    public function testUpdatesBrieItemsBeforeSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_CHEESE, 5, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(11, $items[0]->quality);
    }

    public function testUpdatesBrieItemsBeforeSellDateWithMaximumQuality(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_CHEESE, 5, 50)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesBrieItemsOnSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_CHEESE, 0, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(12, $items[0]->quality);
    }

    public function testUpdatesBrieItemsOnSellDateNearMaximumQuality(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_CHEESE, 0, 49)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesBrieItemsOnSellDateWithMaximumQuality(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_CHEESE, 0, 50)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesBrieItemsAfterSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_CHEESE, -10, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(-11, $items[0]->sellIn);
        $this->assertSame(12, $items[0]->quality);
    }

    public function testUpdatesBrieItemsAfterSellDateWithMaximumQuality(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_CHEESE, -10, 50)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(-11, $items[0]->sellIn);
        $this->assertSame(50, $items[0]->quality);
    }

    //-----------------
    // Sulfuras item
    //-----------------
    public function testUpdatesSulfurasItemsBeforeSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_SULFURAS, 5, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(5, $items[0]->sellIn);
        $this->assertSame(10, $items[0]->quality);
    }

    public function testUpdatesSulfurasItemsOnSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_SULFURAS, 0, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(0, $items[0]->sellIn);
        $this->assertSame(10, $items[0]->quality);
    }

    public function testUpdatesSulfurasItemsAfterSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_SULFURAS, -1, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(10, $items[0]->quality);
    }

    //-----------------
    // Backstage Pass
    //-----------------
    public function testUpdatesBackstagePassItemsLongBeforeSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_PASSES, 11, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(10, $items[0]->sellIn);
        $this->assertSame(11, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsCloseToBeforeSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_PASSES, 10, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(9, $items[0]->sellIn);
        $this->assertSame(12, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsCloseToSellDateAtMaximumQuality(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_PASSES, 10, 50)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(9, $items[0]->sellIn);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsVeryCloseToSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_PASSES, 5, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(13, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsVeryCloseToSellDateAtMaxiumQuality(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_PASSES, 5, 50)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsWithOneDayLeftToSellDateAtMaxiumQuality(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_PASSES, 1, 50)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(0, $items[0]->sellIn);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsOnSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_PASSES, 0, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsAfterSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_PASSES, -1, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(-2, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }

    //-----------------
    // Conjured
    //-----------------
    public function testUpdatesConjuredItemsBeforeSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_CONJURED, 11, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(10, $items[0]->sellIn);
        $this->assertSame(8, $items[0]->quality);
    }

    public function testUpdatesConjuredItemsOnSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_CONJURED, 0, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(6, $items[0]->quality);
    }

    public function testUpdatesConjuredItemsAfterSellDate(): void
    {
        // arrange
        $items = [new Item(ITEM_NAME_CONJURED, -5, 10)];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(-6, $items[0]->sellIn);
        $this->assertSame(6, $items[0]->quality);
    }

    public function testUpdatesConjuredItemsWithAQualityOf0(): void
    {
        // arrange
        $items = [
            new Item(ITEM_NAME_CONJURED, 5, 0),
            new Item(ITEM_NAME_CONJURED, 10, 0)
        ];
        $app = new GildedRose($items);

        // act
        $app->updateQuality();

        // assert
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
        $this->assertSame(9, $items[1]->sellIn);
        $this->assertSame(0, $items[1]->quality);
    }
}
