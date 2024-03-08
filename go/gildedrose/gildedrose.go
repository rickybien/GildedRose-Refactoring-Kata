package gildedrose

type Item struct {
	Name            string
	SellIn, Quality int
}

func UpdateQuality(items []*Item) {
	for _, item := range items {
		s := getStrategy(item)
		s.UpdateQuality()
		s.UpdateSellIn()
	}
}

func getStrategy(item *Item) Strategy {
	switch item.Name {
	case "Sulfuras, Hand of Ragnaros":
		return &Sulfuras{item}
	case "Aged Brie":
		return &AgedBrie{item}
	case "Backstage passes to a TAFKAL80ETC concert":
		return &BackstagePasses{item}
	case "Conjured":
		return &Conjured{item}
	default:
		return &Normal{item}
	}
}
