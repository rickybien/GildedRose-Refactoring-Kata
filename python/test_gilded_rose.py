# -*- coding: utf-8 -*-
import unittest

from gilded_rose import Item, GildedRose


class GildedRoseTest(unittest.TestCase):

    # normal item
    def test_UpdatesNormalItemsBeforeSellDate(self):
        items = [
            Item(name="normal", sell_in=5, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(4, items[0].sell_in)
        self.assertEqual(9, items[0].quality)

    def testUpdatesNormalItemsOnSellDate(self):
        items = [
            Item(name="normal", sell_in=0, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(-1, items[0].sell_in)
        self.assertEqual(8, items[0].quality)

    def testUpdatesNormalItemsAfterSellDate(self):
        items = [
            Item(name="normal", sell_in=-5, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(-6, items[0].sell_in)
        self.assertEqual(8, items[0].quality)

    def testUpdatesNormalItemsWithAQualityOf0(self):
        items = [
            Item(name="normal", sell_in=5, quality=0),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(4, items[0].sell_in)
        self.assertEqual(0, items[0].quality)

    # Brie Item
    def testUpdatesBrieItemsBeforeSellDate(self):
        items = [
            Item(name="Aged Brie", sell_in=5, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(4, items[0].sell_in)
        self.assertEqual(11, items[0].quality)

    def testUpdatesBrieItemsBeforeSellDateWithMaximumQuality(self):
        items = [
            Item(name="Aged Brie", sell_in=5, quality=50),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(4, items[0].sell_in)
        self.assertEqual(50, items[0].quality)

    def testUpdatesBrieItemsOnSellDate(self):
        items = [
            Item(name="Aged Brie", sell_in=0, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(-1, items[0].sell_in)
        self.assertEqual(12, items[0].quality)

    def testUpdatesBrieItemsOnSellDateNearMaximumQuality(self):
        items = [
            Item(name="Aged Brie", sell_in=0, quality=49),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(-1, items[0].sell_in)
        self.assertEqual(50, items[0].quality)

    def testUpdatesBrieItemsOnSellDateWithMaximumQuality(self):
        items = [
            Item(name="Aged Brie", sell_in=0, quality=50),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(-1, items[0].sell_in)
        self.assertEqual(50, items[0].quality)

    def testUpdatesBrieItemsAfterSellDate(self):
        items = [
            Item(name="Aged Brie", sell_in=-10, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(-11, items[0].sell_in)
        self.assertEqual(12, items[0].quality)

    def testUpdatesBrieItemsAfterSellDateWithMaximumQuality(self):
        items = [
            Item(name="Aged Brie", sell_in=-10, quality=50),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(-11, items[0].sell_in)
        self.assertEqual(50, items[0].quality)

    # Sulfuras Item
    def testUpdatesSulfurasItemsBeforeSellDate(self):
        items = [
            Item(name="Sulfuras, Hand of Ragnaros", sell_in=5, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(5, items[0].sell_in)
        self.assertEqual(10, items[0].quality)

    def testUpdatesSulfurasItemsOnSellDate(self):
        items = [
            Item(name="Sulfuras, Hand of Ragnaros", sell_in=0, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(0, items[0].sell_in)
        self.assertEqual(10, items[0].quality)

    def testUpdatesSulfurasItemsAfterSellDate(self):
        items = [
            Item(name="Sulfuras, Hand of Ragnaros", sell_in=-1, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(-1, items[0].sell_in)
        self.assertEqual(10, items[0].quality)

    # Backstage Pass
    def testUpdatesBackstagePassItemsLongBeforeSellDate(self):
        items = [
            Item(name="Backstage passes to a TAFKAL80ETC concert", sell_in=11, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(10, items[0].sell_in)
        self.assertEqual(11, items[0].quality)

    def testUpdatesBackstagePassItemsCloseToBeforeSellDate(self):
        items = [
            Item(name="Backstage passes to a TAFKAL80ETC concert", sell_in=10, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(9, items[0].sell_in)
        self.assertEqual(12, items[0].quality)

    def testUpdatesBackstagePassItemsCloseToSellDateAtMaximumQuality(self):
        items = [
            Item(name="Backstage passes to a TAFKAL80ETC concert", sell_in=10, quality=50),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(9, items[0].sell_in)
        self.assertEqual(50, items[0].quality)

    def testUpdatesBackstagePassItemsVeryCloseToSellDate(self):
        items = [
            Item(name="Backstage passes to a TAFKAL80ETC concert", sell_in=5, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(4, items[0].sell_in)
        self.assertEqual(13, items[0].quality)

    def testUpdatesBackstagePassItemsVeryCloseToSellDateAtMaximumQuality(self):
        items = [
            Item(name="Backstage passes to a TAFKAL80ETC concert", sell_in=5, quality=50),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(4, items[0].sell_in)
        self.assertEqual(50, items[0].quality)

    def testUpdatesBackstagePassItemsWithOneDayLeftToSellDateAtMaximumQuality(self):
        items = [
            Item(name="Backstage passes to a TAFKAL80ETC concert", sell_in=1, quality=50),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(0, items[0].sell_in)
        self.assertEqual(50, items[0].quality)

    def testUpdatesBackstagePassItemsOnSellDate(self):
        items = [
            Item(name="Backstage passes to a TAFKAL80ETC concert", sell_in=0, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(-1, items[0].sell_in)
        self.assertEqual(0, items[0].quality)

    def testUpdatesBackstagePassItemsAfterSellDate(self):
        items = [
            Item(name="Backstage passes to a TAFKAL80ETC concert", sell_in=-1, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(-2, items[0].sell_in)
        self.assertEqual(0, items[0].quality)

    # Conjured
    def testUpdatesConjuredItemsBeforeSellDate(self):
        items = [
            Item(name="Conjured Mana Cake", sell_in=6, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(5, items[0].sell_in)
        self.assertEqual(8, items[0].quality)

    def testUpdatesNormalItemsOnSellDate(self):
        items = [
            Item(name="Conjured Mana Cake", sell_in=0, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(-1, items[0].sell_in)
        self.assertEqual(6, items[0].quality)

    def testUpdatesNormalItemsAfterSellDate(self):
        items = [
            Item(name="Conjured Mana Cake", sell_in=-5, quality=10),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(-6, items[0].sell_in)
        self.assertEqual(6, items[0].quality)

    def testUpdatesNormalItemsWithAQualityOf0(self):
        items = [
            Item(name="Conjured Mana Cake", sell_in=5, quality=0),
        ]
        gilded_rose = GildedRose(items)
        gilded_rose.update_quality()
        self.assertEqual(4, items[0].sell_in)
        self.assertEqual(0, items[0].quality)

if __name__ == '__main__':
    unittest.main()
