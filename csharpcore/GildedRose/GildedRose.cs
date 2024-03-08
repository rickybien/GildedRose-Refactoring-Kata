using System;
using System.Collections.Generic;

namespace GildedRoseKata
{
    public class GildedRose
    {
        IList<Item> Items;
        public GildedRose(IList<Item> Items)
        {
            this.Items = Items;
        }

        // public void UpdateQuality2()
        // {
        //     for (var i = 0; i < Items.Count; i++)
        //     {
        //         if (Items[i].Name != "Aged Brie" && Items[i].Name != "Backstage passes to a TAFKAL80ETC concert")
        //         {
        //             if (Items[i].Quality > 0)
        //             {
        //                 if (Items[i].Name != "Sulfuras, Hand of Ragnaros")
        //                 {
        //                     Items[i].Quality = Items[i].Quality - 1;
        //                 }
        //             }
        //         }
        //         else
        //         {
        //             if (Items[i].Quality < 50)
        //             {
        //                 Items[i].Quality = Items[i].Quality + 1;

        //                 if (Items[i].Name == "Backstage passes to a TAFKAL80ETC concert")
        //                 {
        //                     if (Items[i].SellIn < 11)
        //                     {
        //                         if (Items[i].Quality < 50)
        //                         {
        //                             Items[i].Quality = Items[i].Quality + 1;
        //                         }
        //                     }

        //                     if (Items[i].SellIn < 6)
        //                     {
        //                         if (Items[i].Quality < 50)
        //                         {
        //                             Items[i].Quality = Items[i].Quality + 1;
        //                         }
        //                     }
        //                 }
        //             }
        //         }

        //         if (Items[i].Name != "Sulfuras, Hand of Ragnaros")
        //         {
        //             Items[i].SellIn = Items[i].SellIn - 1;
        //         }

        //         if (Items[i].SellIn < 0)
        //         {
        //             if (Items[i].Name != "Aged Brie")
        //             {
        //                 if (Items[i].Name != "Backstage passes to a TAFKAL80ETC concert")
        //                 {
        //                     if (Items[i].Quality > 0)
        //                     {
        //                         if (Items[i].Name != "Sulfuras, Hand of Ragnaros")
        //                         {
        //                             Items[i].Quality = Items[i].Quality - 1;
        //                         }
        //                     }
        //                 }
        //                 else
        //                 {
        //                     Items[i].Quality = Items[i].Quality - Items[i].Quality;
        //                 }
        //             }
        //             else
        //             {
        //                 if (Items[i].Quality < 50)
        //                 {
        //                     Items[i].Quality = Items[i].Quality + 1;
        //                 }
        //             }
        //         }
        //     }
        // }
        public int UpdateNormalQty(Item NormalItem)//一般物品
        {
            
            if (NormalItem.Quality > 0)
            {
                NormalItem.Quality = NormalItem.Quality - 1;
            }
            if(CheckSellIn(item:NormalItem))
            {
                NormalItem.Quality=  NormalItem.Quality - 1;
            }
            return NormalItem.Quality < 0 ? 0 : NormalItem.Quality;
        }
        public int UpdateAgedBrieQty(Item AgedBrieItem)//AgeBrie
        {
            
            if (AgedBrieItem.Quality < 50)
            {
                AgedBrieItem.Quality = AgedBrieItem.Quality + 1;
            }
            if(CheckSellIn(AgedBrieItem))//超過期限以雙倍提高品質
            {
                AgedBrieItem.Quality = AgedBrieItem.Quality + 1;
            }
            return AgedBrieItem.Quality >= 50 ? 50 : AgedBrieItem.Quality;
        }
        public int UpdateBackstagePassesQty(Item BackstagePassesItem)//BackstagePasses
        {
            
            if (BackstagePassesItem.Quality < 50)
            {
                BackstagePassesItem.Quality = BackstagePassesItem.Quality + 1;
                if (BackstagePassesItem.SellIn < 11)
                {
                    if (BackstagePassesItem.Quality < 50)
                    {
                        BackstagePassesItem.Quality = BackstagePassesItem.Quality + 1;
                    }
                }
                if (BackstagePassesItem.SellIn < 6)
                {
                    if (BackstagePassesItem.Quality < 50)
                    {
                        BackstagePassesItem.Quality = BackstagePassesItem.Quality + 1;
                    }
                }
            }
            
            if(CheckSellIn(BackstagePassesItem))
            {
                return 0;
            }
            return BackstagePassesItem.Quality;
        }
        public int UpdateConjuredQty(Item ConjuredItem)//Conjured
        {
            
            if (ConjuredItem.Quality > 0)
            {
                ConjuredItem.Quality = ConjuredItem.Quality - 2;
            }
            if(CheckSellIn(ConjuredItem))//超過期限再扣兩倍
            {
                ConjuredItem.Quality=ConjuredItem.Quality-2;
            }
            
            return ConjuredItem.Quality < 0 ? 0 : ConjuredItem.Quality;
        }
        public ItemType itemType(string ItemName)
        {
            if (ItemName == "Aged Brie")//隨著時間而提高品質`Quality`
            {
                return ItemType.AgedBrie;
            }
            else if (ItemName == "Backstage passes to a TAFKAL80ETC concert")//隨著時間而提高；還剩10天或更少的时候，品質`Quality`每天提高2；當剩5天或更少的时候，品質`Quality`每天提高3；但一旦過期，品質就會降為0
            {
                return ItemType.BackstagePasses;
            }
            else if (ItemName == "Sulfuras, Hand of Ragnaros")//不會動，不用理他
            {
                return ItemType.Sulfuras;
            }
            else if (ItemName=="Conjured")//品質比一般正常物品下降快一倍
            {
                return ItemType.Conjured;
            }
            else
            {
                return ItemType.Normal;
            }            
        }
        public bool CheckSellIn(Item item)//檢查銷售日期是否過期
        {
            item.SellIn=item.SellIn-1;
            if (item.SellIn < 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public void UpdateQuality()
        {
            try
            {
                foreach(var item in Items)
                {
                    var Type=itemType(item.Name);//先確認商品為甚麼型別
                    switch(Type)
                    {
                        case ItemType.AgedBrie:
                            item.Quality= UpdateAgedBrieQty(item);
                            break;
                        case ItemType.BackstagePasses:
                            item.Quality=UpdateBackstagePassesQty(item);
                            break;
                        case ItemType.Sulfuras:
                            break;
                        case ItemType.Conjured:
                            item.Quality=UpdateConjuredQty(item);
                            break;
                        case ItemType.Normal:
                            item.Quality=UpdateNormalQty(item);
                            break;
                    }

                }
            }
            catch(Exception ex)
            {
                throw ex;
            }
        }
        
    }
}
