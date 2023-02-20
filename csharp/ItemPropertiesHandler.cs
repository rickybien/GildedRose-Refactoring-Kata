using System;
namespace csharp
{
	public class ItemPropertiesHandler
	{
        private readonly int _minQuality = 0;
        private readonly int _maxQuality = 50;

        public int QualityUpdate(Item item)
		{
            int quality = item.Quality;

            // Special Case
            if (item.Name == "Sulfuras, Hand of Ragnaros") // 传奇物品"Sulfuras"（萨弗拉斯—炎魔拉格纳罗斯之手）永不过期，也不会降低品质`Quality`
            {
                // 每种物品的品质不会超过50，然而"Sulfuras"（萨弗拉斯—炎魔拉格纳罗斯之手）是一个传奇物品，因此它的品质是80且永远不变。
                quality = 80;
                return quality;
            }

            // `Quality` 永远不会为负值 && 永远不会超过50
            if (quality <= _minQuality && quality >= _maxQuality)
                return quality;
            
            // 例外處理："Backstage passes"（后台通行证）与"Aged Brie"（陈年布利奶酪）类似，其品质`Quality`会随着时间推移而提高
            if (item.Name == "Aged Brie" || item.Name == "Backstage passes to a TAFKAL80ETC concert")
            {
                if (item.SellIn > 10 )
                    quality += 1;
                //当还剩10天或更少的时候，品质`Quality`每天提高2
                else if (item.SellIn <= 10 && item.SellIn > 5)
                    quality += 2;
                //当还剩5天或更少的时候，品质`Quality`每天提高3；
                else if (item.SellIn <= 5 && item.SellIn > 0)
                    quality += 3;
                //  但一旦过期，品质就会降为0 ，或是 在剩0天的狀況，隔天就會過期
                else if (item.SellIn <= 0)
                    quality = 0;
            }
            //"Conjured"（召唤物品）的品质`Quality`下降速度比正常物品快一倍
            else if ( item.Name == "Conjured Mana Cake")
            {
                quality -= 2;
            }
            else // Common Case
            {
                quality -= 1;
            }

            // `Quality` 永远不会为负值 
            if (quality <= _minQuality)
                return _minQuality;

            // `Quality` 永远不会超过50 
            if (quality >= _maxQuality)
                return _maxQuality;

            return quality;
        }

        public int SellInUpdate(Item item)
        {
            int sellIn = item.SellIn;

            // Special Case
            if (item.Name == "Sulfuras, Hand of Ragnaros") // 传奇物品"Sulfuras"（萨弗拉斯—炎魔拉格纳罗斯之手）永不过期
            {
                return sellIn;
            }

            // Common Case
            sellIn--; // 每天结束时，系统会降低每种物品的这个数值

            return sellIn;
        }
    }
}

