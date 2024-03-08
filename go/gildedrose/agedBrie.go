package gildedrose

type AgedBrie struct {
	*Item
}

func (item *AgedBrie) UpdateSellIn() {
	item.Item.SellIn -= 1
}

func (item *AgedBrie) UpdateQuality() {
	if item.Item.Quality < 50 {
		if item.Item.SellIn <= 0 {
			item.Item.Quality += 2
		} else {
			item.Item.Quality += 1
		}
	}
	if item.Item.Quality > 50 {
		item.Item.Quality = 50
	}
}
