using NUnit.Framework;
using System.Collections.Generic;

namespace csharp
{
    [TestFixture]
    public class GildedRoseTest
    {
        [Test]
        public void foo()
        {
            IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = 4, Quality = 50 } };
            GildedRose app = new GildedRose(Items);
            app.UpdateProperties();
            Assert.AreEqual("Conjured Mana Cake", Items[0].Name);
        }
    }
}
