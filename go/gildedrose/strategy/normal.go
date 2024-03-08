package strategy

import "github.com/emilybache/gildedrose-refactoring-kata/gildedrose/item"

type Normal struct {
	*item.Item
}

func (item *Normal) UpdateSellIn() {
	item.Item.SellIn -= 1
}

func (item *Normal) UpdateQuality() {
	switch {
	case item.Item.SellIn <= 0:
		item.Item.Quality -= 2
	default:
		item.Item.Quality -= 1
	}
	if item.Item.Quality < 0 {
		item.Item.Quality = 0
	}
}
