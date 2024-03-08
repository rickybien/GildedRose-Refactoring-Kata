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

        public void UpdateQuality()
        {
            foreach(var item in Items)
            {
                //處理后台通行证與陈年布利奶酪
                if (item.Name == "Aged Brie" || item.Name == "Backstage passes to a TAFKAL80ETC concert")
                {

                    item.Quality = item.Quality < 50 ? item.Quality + 1 : item.Quality;
                    //處理后台通行证
                    if (item.Name == "Backstage passes to a TAFKAL80ETC concert")
                    {
                        //天數5<x<10會再增加一
                        if (item.SellIn <= 10)
                        {
                            item.Quality = item.Quality < 50 ? item.Quality + 1 : 50;
                        }
                        //天數x<=5會再增加一
                        if (item.SellIn <= 5)
                        {
                            item.Quality = item.Quality < 50 ? item.Quality + 1 : 50;
                        }
                        if (item.SellIn <= 0)
                        {
                            item.Quality = 0;
                        }
                    }
                    else
                    {
                        //處理陳年乳酪過了銷售日品質會再加一
                        if(item.SellIn<=0)
                            item.Quality = item.Quality < 50 ? item.Quality + 1 : 50;
                    }
                    
                    item.SellIn--;

                }
                else if (item.Name == "Sulfuras, Hand of Ragnaros")//不處理傳奇物件
                {
                    continue;
                }
                else//其餘商品 
                {
                    //品質大於零時每天減少一點
                    item.Quality = item.Quality > 0 ? item.Quality - 1 : 0;
                    if (item.Name == "Conjured Mana Cake")//新需求加入cake
                    {
                        item.Quality = item.Quality > 0 ? item.Quality - 1 : 0;
                    }
                    item.SellIn--;
                    if (item.SellIn < 0 && item.Quality > 0)
                    {
                        item.Quality = item.Quality - 1;
                        if (item.Name == "Conjured Mana Cake" && item.Quality>0)//新需求加入cake品質都會增加一
                        {
                            item.Quality = item.Quality - 1;
                        }
                    }
                    
                }
                
            }
        }
    }
}
