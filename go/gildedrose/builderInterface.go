package gildedrose

type IBuilder interface {
	calculSellIn(item *Item)
	calculQuality(item *Item)
	getCalculItem() CulcalItem
}

func getBuilder(builderType string) IBuilder {
	if builderType == "Sulfuras, Hand of Ragnaros" {
		return newSulfurasBuilder()
	}

	if builderType == "Aged Brie" {
		return newAgedBrieBuilder()
	}

	if builderType == "Backstage passes to a TAFKAL80ETC concert" {
		return newBackstagePassesBuilder()
	}

	return newOtherBuilder()
}
