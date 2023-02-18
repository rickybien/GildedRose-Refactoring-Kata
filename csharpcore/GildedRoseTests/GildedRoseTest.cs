using Xunit;
using System.Collections.Generic;
using GildedRoseKata;

namespace GildedRoseTests
{
    public class GildedRoseTest
    {
        [Fact]
        public void testCase1()
        {
            //IList<Item> Items = new List<Item> { new Item { Name = "foo", SellIn = 0, Quality = 0 } };
            //GildedRose app = new GildedRose(Items);
            //app.UpdateQuality();
            //Assert.Equal("fixme", Items[0].Name);
            IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = 5, Quality = 10 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();
            Assert.Equal(4, Items[0].SellIn);
            Assert.Equal(8, Items[0].Quality);

            app.UpdateQuality();
            Assert.Equal(3, Items[0].SellIn);
            Assert.Equal(6, Items[0].Quality);
            app.UpdateQuality();
            Assert.Equal(2, Items[0].SellIn);
            Assert.Equal(4, Items[0].Quality);
        }

        [Fact]
        public void testCase2()
        {
            //IList<Item> Items = new List<Item> { new Item { Name = "foo", SellIn = 0, Quality = 0 } };
            //GildedRose app = new GildedRose(Items);
            //app.UpdateQuality();
            //Assert.Equal("fixme", Items[0].Name);
            IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = 5, Quality = 10 },
                                                 new Item { Name = "Sulfuras, Hand of Ragnaros", SellIn = 5, Quality = 80 } };
     
            GildedRose app = new GildedRose(Items);
            app.UpdateQuality();


            foreach(var item in Items)
            {
                if (item.Name == "Conjured Mana Cake")
                {
                    Assert.Equal(4, item.SellIn);
                    Assert.Equal(8, item.Quality);
                }
                else
                {
                    Assert.Equal(80, item.Quality);
                    Assert.Equal(5, item.SellIn);
                }
            }

            app.UpdateQuality();


            foreach (var item in Items)
            {
                if (item.Name == "Conjured Mana Cake")
                {
                    Assert.Equal(3, item.SellIn);
                    Assert.Equal(6, item.Quality);
                }
                else
                {
                    Assert.Equal(80, item.Quality);
                    Assert.Equal(5, item.SellIn);
                }
            }
        }
    }
}
