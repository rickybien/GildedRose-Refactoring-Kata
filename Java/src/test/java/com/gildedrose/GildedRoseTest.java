package com.gildedrose;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.assertEquals;

class GildedRoseTest {
    //----------
    // normal item
    //----------
    @Test
    void testUpdatesNormalItemsBeforeSellDate() {
        Item[] items = new Item[] { new Item("normal", 5, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(4, app.items[0].sellIn);
        assertEquals(9, app.items[0].quality);
    }

    @Test
    void testUpdatesNormalItemsOnSellDate() {
        Item[] items = new Item[] { new Item("normal", 0, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(-1, app.items[0].sellIn);
        assertEquals(8, app.items[0].quality);
    }

    @Test
    void testUpdatesNormalItemsAfterSellDate() {
        Item[] items = new Item[] { new Item("normal", -5, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(-6, app.items[0].sellIn);
        assertEquals(8, app.items[0].quality);
    }

    @Test
    void testUpdatesNormalItemsWithAQualityOf0() {
        Item[] items = new Item[] { new Item("normal", 5, 0) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(4, app.items[0].sellIn);
        assertEquals(0, app.items[0].quality);
    }

    //-------------
    // Brie Item
    //-------------
    @Test
    void testUpdatesBrieItemsBeforeSellDate() {
        Item[] items = new Item[] { new Item("Aged Brie", 5, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(4, app.items[0].sellIn);
        assertEquals(11, app.items[0].quality);
    }

    @Test
    void testUpdatesBrieItemsBeforeSellDateWithMaximumQuality() {
        Item[] items = new Item[] { new Item("Aged Brie", 5, 50) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(4, app.items[0].sellIn);
        assertEquals(50, app.items[0].quality);
    }

    @Test
    void testUpdatesBrieItemsOnSellDate() {
        Item[] items = new Item[] { new Item("Aged Brie", 0, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(-1, app.items[0].sellIn);
        assertEquals(12, app.items[0].quality);
    }

    @Test
    void testUpdatesBrieItemsOnSellDateNearMaximumQuality() {
        Item[] items = new Item[] { new Item("Aged Brie", 0, 49) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(-1, app.items[0].sellIn);
        assertEquals(50, app.items[0].quality);
    }

    @Test
    void testUpdatesBrieItemsOnSellDateWithMaximumQuality() {
        Item[] items = new Item[] { new Item("Aged Brie", 0, 50) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(-1, app.items[0].sellIn);
        assertEquals(50, app.items[0].quality);
    }

    @Test
    void testUpdatesBrieItemsAfterSellDate() {
        Item[] items = new Item[] { new Item("Aged Brie", -10, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(-11, app.items[0].sellIn);
        assertEquals(12, app.items[0].quality);
    }

    @Test
    void testUpdatesBrieItemsAfterSellDateWithMaximumQuality() {
        Item[] items = new Item[] { new Item("Aged Brie", -10, 50) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(-11, app.items[0].sellIn);
        assertEquals(50, app.items[0].quality);
    }

    //-----------
    // Sulfuras item
    //-----------
    @Test
    void testUpdatesSulfurasItemsBeforeSellDate() {
        Item[] items = new Item[] { new Item("Sulfuras, Hand of Ragnaros", 5, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(5, app.items[0].sellIn);
        assertEquals(10, app.items[0].quality);
    }

    @Test
    void testUpdatesSulfurasItemsOnSellDate() {
        Item[] items = new Item[] { new Item("Sulfuras, Hand of Ragnaros", 0, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(0, app.items[0].sellIn);
        assertEquals(10, app.items[0].quality);
    }

    @Test
    void testUpdatesSulfurasItemsAfterSellDate() {
        Item[] items = new Item[] { new Item("Sulfuras, Hand of Ragnaros", -1, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(-1, app.items[0].sellIn);
        assertEquals(10, app.items[0].quality);
    }

    //----------------
    // Backstage Pass
    //----------------
    @Test
    void testUpdatesBackstagePassItemsLongBeforeSellDate() {
        Item[] items = new Item[] { new Item("Backstage passes to a TAFKAL80ETC concert", 11, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(10, app.items[0].sellIn);
        assertEquals(11, app.items[0].quality);
    }

    @Test
    void testUpdatesBackstagePassItemsCloseToBeforeSellDate() {
        Item[] items = new Item[] { new Item("Backstage passes to a TAFKAL80ETC concert", 10, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(9, app.items[0].sellIn);
        assertEquals(12, app.items[0].quality);
    }

    @Test
    void testUpdatesBackstagePassItemsCloseToSellDateAtMaximumQuality() {
        Item[] items = new Item[] { new Item("Backstage passes to a TAFKAL80ETC concert", 10, 50) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(9, app.items[0].sellIn);
        assertEquals(50, app.items[0].quality);
    }

    @Test
    void testUpdatesBackstagePassItemsVeryCloseToSellDate() {
        Item[] items = new Item[] { new Item("Backstage passes to a TAFKAL80ETC concert", 5, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(4, app.items[0].sellIn);
        assertEquals(13, app.items[0].quality);
    }

    @Test
    void testUpdatesBackstagePassItemsVeryCloseToSellDateAtMaximumQuality() {
        Item[] items = new Item[] { new Item("Backstage passes to a TAFKAL80ETC concert", 5, 50) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(4, app.items[0].sellIn);
        assertEquals(50, app.items[0].quality);
    }

    @Test
    void testUpdatesBackstagePassItemsWithOneDayLeftToSellDateAtMaximumQuality() {
        Item[] items = new Item[] { new Item("Backstage passes to a TAFKAL80ETC concert", 1, 50) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(0, app.items[0].sellIn);
        assertEquals(50, app.items[0].quality);
    }

    @Test
    void testUpdatesBackstagePassItemsOnSellDate() {
        Item[] items = new Item[] { new Item("Backstage passes to a TAFKAL80ETC concert", 0, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(-1, app.items[0].sellIn);
        assertEquals(0, app.items[0].quality);
    }

    @Test
    void testUpdatesBackstagePassItemsAfterSellDate() {
        Item[] items = new Item[] { new Item("Backstage passes to a TAFKAL80ETC concert", -1, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(-2, app.items[0].sellIn);
        assertEquals(0, app.items[0].quality);
    }

    @Test
    void testConjuredItemBeforeSellDate() {
        Item[] items = new Item[] { new Item("Conjured Mana Cake", 5, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(4, app.items[0].sellIn);
        assertEquals(8, app.items[0].quality);
    }

    @Test
    void testConjuredItemAfterSellDate() {
        Item[] items = new Item[] { new Item("Conjured Mana Cake", 0, 10) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(-1, app.items[0].sellIn);
        assertEquals(6, app.items[0].quality);
    }

    @Test
    void testConjuredItemQualityMinimum() {
        Item[] items = new Item[] { new Item("Conjured Mana Cake", 5, 1) };
        GildedRose app = new GildedRose(items);
        app.updateQuality();
        assertEquals(4, app.items[0].sellIn);
        assertEquals(0, app.items[0].quality);
    }
}
