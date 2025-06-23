using System.Collections.Generic;
using GildedRoseKata;
using Xunit;

namespace GildedRoseTests
{
    public class GildedRoseTest
    {
        //---------------
        // normal item
        //---------------
        [Fact]
        public void testUpdatesNormalItemsBeforeSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "normal", SellIn = 5, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(9, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesNormalItemsOnSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "normal", SellIn = 0, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(8, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesNormalItemsAfterSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "normal", SellIn = -5, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-6, Items[0].SellIn);
            Assert.Equal(8, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesNormalItemsWithAQualityOf0()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "normal", SellIn = 5, Quality = 0 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }

        //---------------
        // Brie item
        //---------------
        [Fact]
        public void testUpdatesBrieItemsBeforeSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = 5, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(11, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBrieItemsBeforeSellDateWithMaximumQuality()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = 5, Quality = 50 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBrieItemsOnSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = 0, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(12, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBrieItemsOnSellDateNearMaximumQuality()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = 0, Quality = 49 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBrieItemsOnSellDateWithMaximumQuality()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = 0, Quality = 50 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBrieItemsAfterSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = -10, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-11, Items[0].SellIn);
            Assert.Equal(12, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBrieItemsAfterSellDateWithMaximumQuality()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Aged Brie", SellIn = -10, Quality = 50 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-11, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }

        //---------------
        // Sulfuras item
        //---------------
        [Fact]
        public void testUpdatesSulfurasItemsBeforeSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Sulfuras, Hand of Ragnaros", SellIn = 5, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(5, Items[0].SellIn);
            Assert.Equal(10, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesSulfurasItemsOnSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Sulfuras, Hand of Ragnaros", SellIn = 0, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(0, Items[0].SellIn);
            Assert.Equal(10, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesSulfurasItemsAfterSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Sulfuras, Hand of Ragnaros", SellIn = -1, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(10, Items[0].Quality);
        }

        //---------------
        // Backstage Pass
        //---------------
        [Fact]
        public void testUpdatesBackstagePassItemsLongBeforeSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 11, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(10, Items[0].SellIn);
            Assert.Equal(11, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBackstagePassItemsCloseToBeforeSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 10, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(9, Items[0].SellIn);
            Assert.Equal(12, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBackstagePassItemsCloseToSellDateAtMaximumQuality()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 10, Quality = 50 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(9, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBackstagePassItemsVeryCloseToSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 5, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(13, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBackstagePassItemsVeryCloseToSellDateAtMaximumQuality()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 5, Quality = 50 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBackstagePassItemsWithOneDayLeftToSellDateAtMaximumQuality()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 1, Quality = 50 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(0, Items[0].SellIn);
            Assert.Equal(50, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBackstagePassItemsOnSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = 0, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesBackstagePassItemsAfterSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new Item { Name = "Backstage passes to a TAFKAL80ETC concert", SellIn = -1, Quality = 10 } };
            GildedRose app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-2, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }

        //---------------
        // Conjured item
        // ---------------

        [Fact]
        public void testUpdatesConjuredItemsLongBeforeSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new() { Name = "Conjured", SellIn = 10, Quality = 10 } };
            var app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(9, Items[0].SellIn);
            Assert.Equal(8, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesConjuredItemsCloseToBeforeSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new() { Name = "Conjured", SellIn = 3, Quality = 10 } };
            var app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(2, Items[0].SellIn);
            Assert.Equal(8, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesConjuredItemsWithQualityOf0()
        {
            // arrange
            IList<Item> Items = new List<Item> { new() { Name = "Conjured", SellIn = 2, Quality = 0 } };
            var app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(1, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesConjuredItemsAfterSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new() { Name = "Conjured", SellIn = 0, Quality = 10 } };
            var app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(6, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesConjuredItemsWhiteQualityOf0AfterSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new() { Name = "Conjured", SellIn = 0, Quality = 0 } };
            var app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }

        [Fact]
        public void testUpdatesConjuredItemsWhiteQualityCloseTo0AfterSellDate()
        {
            // arrange
            IList<Item> Items = new List<Item> { new() { Name = "Conjured", SellIn = 0, Quality = 1 } };
            var app = new GildedRose(Items);

            // act
            app.UpdateQuality();

            // assert
            Assert.Equal(-1, Items[0].SellIn);
            Assert.Equal(0, Items[0].Quality);
        }
    }
}
