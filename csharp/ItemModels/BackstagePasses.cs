using System;
namespace csharp.ItemModels
{
	public class BackstagePasses : Common
	{
        public BackstagePasses(Item item) : base(item)
        {
            _item = item;
        }
        public override void UpdateQuality() // "Aged Brie"（陈年布利奶酪）的品质`Quality`会随着时间推移而提高
        {
            if (_item.SellIn > 10)
                _item.Quality += 1;
            //当还剩10天或更少的时候，品质`Quality`每天提高2
            else if (_item.SellIn <= 10 && _item.SellIn > 5)
                _item.Quality += 2;
            //当还剩5天或更少的时候，品质`Quality`每天提高3；
            else if (_item.SellIn <= 5 && _item.SellIn > 0)
                _item.Quality += 3;
            //  但一旦过期，品质就会降为0 ，或是 在剩0天的狀況，隔天就會過期
            else if (_item.SellIn <= 0)
                _item.Quality = 0;

            QuilityAdjust();
        }
    }
}

