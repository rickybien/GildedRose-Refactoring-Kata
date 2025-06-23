using System.Collections.Generic;

namespace GildedRoseKata
{
    public class GildedRose
    {
        private readonly IList<Item> _items;
        public GildedRose(IList<Item> items)
        {
            _items = items;
        }

        public void UpdateQuality()
        {
            var factory = new Factory();

            foreach (var item in _items)
            {
                var itemFactory = factory.Create(item);
                itemFactory.Decline(item);
            }
        }

        public interface IItem
        {
            public Item Decline(Item item);
        }

        public class Factory
        {
            public IItem Create(Item item)
            {
                return item.Name switch
                {
                    "Sulfuras, Hand of Ragnaros" => new Sulfuras(),
                    "Backstage passes to a TAFKAL80ETC concert" => new BackstagePass(),
                    "Aged Brie" => new AgedBrie(),
                    "Conjured" => new Conjured(),
                    _ => new NormalItem()
                };
            }
        }

        public class NormalItem : IItem
        {
            public Item Decline(Item item)
            {
                var declineQuantityUnit = 1;
                var declineQuantityRate = item.SellIn <= 0 ? 2 : 1;

                item.Quality -= declineQuantityUnit * declineQuantityRate;

                if (item.Quality < 0) item.Quality = 0;

                item.SellIn -= 1;
                return item;
            }
        }

        public class Sulfuras : IItem
        {
            public Item Decline(Item item)
            {
                return item;
            }
        }

        public class BackstagePass : IItem
        {
            public Item Decline(Item item)
            {
                if (item.SellIn <= 0)
                {
                    item.SellIn -= 1;
                    item.Quality = 0;
                    return item;
                }

                var declineQuantityUnit = 1;

                if (item.SellIn < 11 && item.SellIn > 5) declineQuantityUnit += 1;
                if (item.SellIn <= 5) declineQuantityUnit += 2;

                item.Quality += declineQuantityUnit;
                
                if (item.Quality > 50) item.Quality = 50;

                item.SellIn -= 1;
                return item;
            }
        }

        public class AgedBrie : IItem
        {
            public Item Decline(Item item)
            {
                item.Quality += 1;

                if (item.SellIn <= 0) item.Quality += 1;

                if (item.Quality > 50) item.Quality = 50;

                item.SellIn -= 1;
                return item;
            }
        }

        public class Conjured : IItem
        {
            public Item Decline(Item item)
            {
                var declineQuantityUnit = 1;
                var declineQuantityRate = item.SellIn <= 0 ? 4 : 2;

                item.Quality -= declineQuantityUnit * declineQuantityRate;
                
                if (item.Quality < 0) item.Quality = 0;

                item.SellIn -= 1;

                return item;
            }
        }
    }
}
