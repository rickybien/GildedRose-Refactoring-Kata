using System;
namespace csharp.ItemModels
{
	public class Sulfuras : Common
	{
		public Sulfuras(Item item) : base(item)
		{
			_item = item;
		}
		public override void UpdateQuality()
		{
            // 每种物品的品质不会超过50，然而"Sulfuras"（萨弗拉斯—炎魔拉格纳罗斯之手）是一个传奇物品，因此它的品质是80且永远不变。
            _item.Quality = 80;
        }
        public override void SellInUpdate() 
        {
            return; // 传奇物品"Sulfuras"（萨弗拉斯—炎魔拉格纳罗斯之手）永不过期
        }
    }
}

