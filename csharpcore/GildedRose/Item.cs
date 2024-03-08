namespace GildedRoseKata
{
    public class Item
    {
        public string Name { get; set; }
        public int SellIn { get; set; }
        public int Quality { get; set; }
    }
    public enum ItemType
    {
        AgedBrie,//隨著時間而提高品質`Quality`
        BackstagePasses,//隨著時間而提高；還剩10天或更少的时候，品質`Quality`每天提高2；當剩5天或更少的时候，品質`Quality`每天提高3；但一旦過期，品質就會降為0

        Sulfuras,//永不過期，也不會降低品質`Quality`
        Conjured,//品質比一般正常物品下降快一倍
        Normal//一般物品品質會以兩倍速度下降
        
        
        
    }
}
