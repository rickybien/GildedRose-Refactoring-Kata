package strategy

import "github.com/emilybache/gildedrose-refactoring-kata/gildedrose/item"

type BackstagePasses struct {
	*item.Item
}

func (item *BackstagePasses) UpdateSellIn() {
	item.Item.SellIn -= 1
}

func (item *BackstagePasses) UpdateQuality() {
	switch {
	case item.Item.SellIn <= 0:
		item.Item.Quality = 0
	case item.Item.SellIn <= 5:
		item.Item.Quality += 3
	case item.Item.SellIn <= 10:
		item.Item.Quality += 2
	default:
		item.Item.Quality += 1
	}
	if item.Item.Quality > 50 {
		item.Item.Quality = 50
	}
}
