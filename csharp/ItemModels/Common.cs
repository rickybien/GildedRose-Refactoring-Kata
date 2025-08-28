using System;
using System.Security.Policy;

namespace csharp.ItemModels
{
	public class Common
	{
        public Item _item;
        private readonly int _minQuality = 0;
        private readonly int _maxQuality = 50;

        public Common(Item item)
        {
            _item = item;
        }
        public void UpdateProperties()
        {
            UpdateQuality();
            SellInUpdate();
        }

        public virtual void UpdateQuality()
        {
            int vibrantValue = 1; // 震盪數值
            if (_item.SellIn <= 0) // 一旦销售期限过期，品质`Quality`会以双倍速度加速增加 or 下降
                vibrantValue *= 2;
            _item.Quality -= vibrantValue;

            // 校正
            QuilityAdjust();

        }

        public virtual void QuilityAdjust()
        {
            // `Quality` 永远不会为负值 
            if (_item.Quality <= _minQuality)
                _item.Quality = _minQuality;

            // `Quality` 永远不会超过50 
            if (_item.Quality >= _maxQuality)
                _item.Quality = _maxQuality;
        }

        public virtual void SellInUpdate()
        {
             _item.SellIn --;  // 每天结束时，系统会降低每种物品的这个数值
        }
    }
}

