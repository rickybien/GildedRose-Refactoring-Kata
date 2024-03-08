using System.Collections.Generic;

namespace csharp
{
    public class GildedRose
    {
        IList<Item> Items;
        public GildedRose(IList<Item> Items)
        {
            this.Items = Items;
        }

        public void UpdateProperties()
        {

            for (var i = 0; i < Items.Count; i++)
            {
                var item = Items[i];
                ItemPropertiesHandler itemPropertiesHandler = new ItemPropertiesHandler(item);
                itemPropertiesHandler.UpdateProperties();
            }
        }
    }
}
