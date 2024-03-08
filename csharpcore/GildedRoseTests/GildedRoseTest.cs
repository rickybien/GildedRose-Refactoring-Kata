using Xunit;
using System.Collections.Generic;
using GildedRoseKata;

namespace GildedRoseTests
{
    public class GildedRoseTest
    {
        [Fact]
        public void testUpdatesNormalItemsBeforeSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "normal", SellIn = 5, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(9, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesNormalItemsOnSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "normal", SellIn = 0, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(8, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesNormalItemsAfterSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "normal", SellIn = -5, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(-6, Items[0].SellIn);
            Assert.Equal(8, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesNormalItemsWithAQualityOf0()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "normal", SellIn = 5, Quality = 0 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }
        // Brie item
        [Fact]
        public void testUpdatesBrieItemsBeforeSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = 5, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(11, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBrieItemsBeforeSellDateWithMaximumQuality()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = 5, Quality = 50 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBrieItemsOnSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = 0, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(12, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBrieItemsOnSellDateWithMaximumQuality()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = 0, Quality = 50 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBrieItemsAfterSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = -10, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(-11, Items[0].SellIn);
            Assert.Equal(12, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBrieItemsAfterSellDateWithMaximumQuality()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = -10, Quality = 50 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(-11, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }
        // Sulfuras item
        [Fact]
        public void testUpdatesSulfurasItemsBeforeSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Sulfuras, Hand of Ragnaros", SellIn = 5, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(5, Items[0].SellIn);
            Assert.Equal(10, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesSulfurasItemsOnSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Sulfuras, Hand of Ragnaros", SellIn = 0, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(0, Items[0].SellIn);
            Assert.Equal(10, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesSulfurasItemsAfterSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Sulfuras, Hand of Ragnaros", SellIn = -1, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(10, Items[0].Quality);
        }
        // Backstage Pass
        [Fact]
        public void testUpdatesBackstagePassItemsLongBeforeSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 11, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(10, Items[0].SellIn);
            Assert.Equal(11, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBackstagePassItemsCloseToBeforeSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 10, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(9, Items[0].SellIn);
            Assert.Equal(12, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBackstagePassItemsCloseToSellDateAtMaximumQuality()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 10, Quality = 50 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(9, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBackstagePassItemsVeryCloseToSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 5, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(13, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBackstagePassItemsVeryCloseToSellDateAtMaxiumQuality()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 5, Quality = 50 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBackstagePassItemsWithOneDayLeftToSellDateAtMaxiumQuality()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 1, Quality = 50 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(0, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBackstagePassItemsOnSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 0, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBackstagePassItemsAfterSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = -1, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(-2, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }
        // Conjured Mana Cake
        [Fact]
        public void testUpdatesConjuredManaCakeItemsLongBeforeSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = 3, Quality = 6 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(2, Items[0].SellIn);
            Assert.Equal(4, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesConjuredManaCakeItemsCloseToBeforeSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = 10, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(9, Items[0].SellIn);
            Assert.Equal(8, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesConjuredManaCakeItemsCloseToSellDateAtMaximumQuality()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = 10, Quality = 50 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(9, Items[0].SellIn);
            Assert.Equal(48, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesConjuredManaCakeItemsWithOneDayLeftToSellDateAtMaxiumQuality()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = 1, Quality = 50 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(0, Items[0].SellIn);
            Assert.Equal(48, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesConjuredManaCakeItemsOnSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = 0, Quality = 3 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesConjuredManaCakeItemsAfterSellDate()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = -1, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(-2, Items[0].SellIn);
            Assert.Equal(6, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBackstagePassItemsVeryCloseToSellDateAtMiniumQuality()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = 5, Quality = 0 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBackstagePassItemsVeryBeforeSellDateAtMiniumQuality()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = 10, Quality = 0 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(9, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }
        [Fact]
        public void testUpdatesBackstagePassItemsVeryAfterSellDateAtMiniumQuality()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = -1, Quality = 0 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(-2, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }
    }
}
