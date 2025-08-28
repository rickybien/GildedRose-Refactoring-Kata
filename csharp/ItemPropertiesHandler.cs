using System;
using csharp.ItemModels;
using System.Collections.Generic;

namespace csharp
{
    public class ItemPropertiesHandler
    {
        private Item _item;
        private Dictionary<string, Common> _itemMappingList;

        public ItemPropertiesHandler(Item item)
        {
            _item = item;
            _itemMappingList = new Dictionary<string, Common>()
            {
                { "Sulfuras, Hand of Ragnaros", new Sulfuras(item) },
                { "Aged Brie",  new AgedBrie(item) },
                {"Backstage passes to a TAFKAL80ETC concert",  new BackstagePasses(item) },
                {"Conjured Mana Cake", new Conjured(item) }
            };
        }

        public void UpdateProperties()
        {
            if (_itemMappingList.ContainsKey(_item.Name))
            {
                _itemMappingList[_item.Name].UpdateProperties();
            }
            else // Normal Case
            {
                Common common = new Common(_item);
                common.UpdateProperties();
            }
        }
    }
}

