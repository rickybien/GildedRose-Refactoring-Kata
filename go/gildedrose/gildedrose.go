package gildedrose

import (
	"github.com/emilybache/gildedrose-refactoring-kata/gildedrose/item"
	"github.com/emilybache/gildedrose-refactoring-kata/gildedrose/strategy"
)

func UpdateQuality(items []*item.Item) {
	for _, item := range items {
		s := getStrategy(item)
		s.UpdateQuality()
		s.UpdateSellIn()
	}
}

func getStrategy(item *item.Item) strategy.Strategy {
	switch item.Name {
	case "Sulfuras, Hand of Ragnaros":
		return &strategy.Sulfuras{Item: item}
	case "Aged Brie":
		return &strategy.AgedBrie{Item: item}
	case "Backstage passes to a TAFKAL80ETC concert":
		return &strategy.BackstagePasses{Item: item}
	case "Conjured":
		return &strategy.Conjured{Item: item}
	default:
		return &strategy.Normal{Item: item}
	}
}
