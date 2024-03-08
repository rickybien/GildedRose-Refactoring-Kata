package gildedrose

type Conjured struct {
	*Item
}

func (item *Conjured) UpdateSellIn() {
	item.Item.SellIn -= 1
}

func (item *Conjured) UpdateQuality() {
	switch {
	case item.Item.SellIn <= 0:
		item.Item.Quality -= 4
	default:
		item.Item.Quality -= 2
	}
	if item.Item.Quality < 0 {
		item.Item.Quality = 0
	}
}
