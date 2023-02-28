using System;
using System.Security.Policy;

namespace csharp.ItemModels
{
	public class Conjured : Common
	{
        public Conjured(Item item) : base(item)
        {
            _item = item;
        }

        public override void UpdateQuality() // "Aged Brie"（陈年布利奶酪）的品质`Quality`会随着时间推移而提高
        {
            int vibrantValue = 2; //"Conjured"（召唤物品）的品质`Quality`下降速度比正常物品快一倍
            if (_item.SellIn <= 0) // 一旦销售期限过期，品质`Quality`会以双倍速度加速增加 or 下降
                vibrantValue *= 2;

            _item.Quality -= vibrantValue;
            QuilityAdjust();
        }
    }
}

