package com.gildedrose

import org.junit.jupiter.api.Assertions.assertEquals
import org.junit.jupiter.api.Test

internal class GildedRoseTest {

    //-------------------
    // normal item
    //-------------------
    @Test
    fun updatesNormalItemsBeforeSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("normal", 5, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(4, app.items[0].sellIn)
        assertEquals(9, app.items[0].quality)
    }

    @Test
    fun updatesNormalItemsOnSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("normal", 0, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(-1, app.items[0].sellIn)
        assertEquals(8, app.items[0].quality)
    }

    @Test
    fun updatesNormalItemsAfterSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("normal", -5, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(-6, app.items[0].sellIn)
        assertEquals(8, app.items[0].quality)
    }

    @Test
    fun updatesNormalItemsWithAQualityOf0() {
        // arrange
        val items = arrayOf<Item>(Item("normal", 5, 0))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(4, app.items[0].sellIn)
        assertEquals(0, app.items[0].quality)
    }

    //-------------------
    // Brie item
    //-------------------
    @Test
    fun updatesBrieItemsBeforeSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("Aged Brie", 5, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(4, app.items[0].sellIn)
        assertEquals(11, app.items[0].quality)
    }

    @Test
    fun updatesBrieItemsBeforeSellDateWithMaximumQuality() {
        // arrange
        val items = arrayOf<Item>(Item("Aged Brie", 5, 50))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(4, app.items[0].sellIn)
        assertEquals(50, app.items[0].quality)
    }

    @Test
    fun updatesBrieItemsOnSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("Aged Brie", 0, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(-1, app.items[0].sellIn)
        assertEquals(12, app.items[0].quality)
    }

    @Test
    fun updatesBrieItemsOnSellDateNearMaximumQuality() {
        // arrange
        val items = arrayOf<Item>(Item("Aged Brie", 0, 49))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(-1, app.items[0].sellIn)
        assertEquals(50, app.items[0].quality)
    }

    @Test
    fun updatesBrieItemsOnSellDateWithMaximumQuality() {
        // arrange
        val items = arrayOf<Item>(Item("Aged Brie", 0, 50))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(-1, app.items[0].sellIn)
        assertEquals(50, app.items[0].quality)
    }

    @Test
    fun updatesBrieItemsAfterSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("Aged Brie", -10, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(-11, app.items[0].sellIn)
        assertEquals(12, app.items[0].quality)
    }

    @Test
    fun updatesBrieItemsAfterSellDateWithMaximumQuality() {
        // arrange
        val items = arrayOf<Item>(Item("Aged Brie", -10, 50))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(-11, app.items[0].sellIn)
        assertEquals(50, app.items[0].quality)
    }

    //-------------------
    // Sulfuras item
    //-------------------
    @Test
    fun updatesSulfurasItemsBeforeSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("Sulfuras, Hand of Ragnaros", 5, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(5, app.items[0].sellIn)
        assertEquals(10, app.items[0].quality)
    }

    @Test
    fun updatesSulfurasItemsOnSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("Sulfuras, Hand of Ragnaros", 0, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(0, app.items[0].sellIn)
        assertEquals(10, app.items[0].quality)
    }

    @Test
    fun updatesSulfurasItemsAfterSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("Sulfuras, Hand of Ragnaros", -1, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(-1, app.items[0].sellIn)
        assertEquals(10, app.items[0].quality)
    }

    //-------------------
    // Backstage Pass
    //-------------------
    @Test
    fun updatesBackstagePassItemsLongBeforeSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("Backstage passes to a TAFKAL80ETC concert", 11, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(10, app.items[0].sellIn)
        assertEquals(11, app.items[0].quality)
    }

    @Test
    fun updatesBackstagePassItemsCloseToBeforeSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("Backstage passes to a TAFKAL80ETC concert", 10, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(9, app.items[0].sellIn)
        assertEquals(12, app.items[0].quality)
    }

    @Test
    fun updatesBackstagePassItemsCloseToSellDateAtMaximumQuality() {
        // arrange
        val items = arrayOf<Item>(Item("Backstage passes to a TAFKAL80ETC concert", 10, 50))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(9, app.items[0].sellIn)
        assertEquals(50, app.items[0].quality)
    }

    @Test
    fun updatesBackstagePassItemsVeryCloseToSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("Backstage passes to a TAFKAL80ETC concert", 5, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(4, app.items[0].sellIn)
        assertEquals(13, app.items[0].quality)
    }

    @Test
    fun updatesBackstagePassItemsVeryCloseToSellDateAtMaximumQuality() {
        // arrange
        val items = arrayOf<Item>(Item("Backstage passes to a TAFKAL80ETC concert", 5, 50))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(4, app.items[0].sellIn)
        assertEquals(50, app.items[0].quality)
    }

    @Test
    fun updatesBackstagePassItemsWithOneDayLeftToSellDateAtMaximumQuality() {
        // arrange
        val items = arrayOf<Item>(Item("Backstage passes to a TAFKAL80ETC concert", 1, 50))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(0, app.items[0].sellIn)
        assertEquals(50, app.items[0].quality)
    }

    @Test
    fun updatesBackstagePassItemsOnSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("Backstage passes to a TAFKAL80ETC concert", 0, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(-1, app.items[0].sellIn)
        assertEquals(0, app.items[0].quality)
    }

    @Test
    fun updatesBackstagePassItemsAfterSellDate() {
        // arrange
        val items = arrayOf<Item>(Item("Backstage passes to a TAFKAL80ETC concert", -1, 10))
        val app = GildedRose(items)

        // act
        app.updateQuality()

        // assert
        assertEquals(-2, app.items[0].sellIn)
        assertEquals(0, app.items[0].quality)
    }
}
