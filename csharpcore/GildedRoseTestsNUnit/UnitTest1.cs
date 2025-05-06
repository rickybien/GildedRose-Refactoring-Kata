using GildedRoseKata;
using GildedRoseTests;


namespace GildedRoseTestsNUnit;

public class Tests
{
    [SetUp]
    public void Setup()
    {

    }

    [Test]
    public void Test1()
    {
        IList<Item> Items = new List<Item> { new Item { Name = "Conjured Mana Cake", SellIn = 5, Quality = 10 },
                                             new Item { Name = "Conjured Mana Cake", SellIn = 1, Quality = 10 } };
        
        GildedRose app = new GildedRose(Items);
        app.UpdateQuality();
        Assert.AreEqual(4 , Items[0].SellIn);
        Assert.AreEqual(8, Items[0].Quality);
        Assert.AreEqual(0, Items[1].SellIn);
        Assert.AreEqual(8, Items[1].Quality);

        app.UpdateQuality();
        Assert.That(Items[0].SellIn, Is.EqualTo(3));
        Assert.That(Items[0].Quality, Is.EqualTo(6));
        Assert.That(Items[1].SellIn, Is.EqualTo(-1));
        Assert.That(Items[1].Quality, Is.EqualTo(4)); //過期下降2倍
    }
}
