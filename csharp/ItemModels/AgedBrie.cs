using System;
namespace csharp.ItemModels
{
	public class AgedBrie : Common
	{
        public AgedBrie(Item item) : base ( item)
        {
            _item = item;
        }

        public override void UpdateQuality() // "Aged Brie"（陈年布利奶酪）的品质`Quality`会随着时间推移而提高
        {
            int vibrantValue = 1; // 震盪數值
            if (_item.SellIn <= 0) // 一旦销售期限过期，品质`Quality`会以双倍速度加速增加 or 下降
                vibrantValue *= 2;
            _item.Quality += vibrantValue;
            QuilityAdjust();
        }
    }
}

